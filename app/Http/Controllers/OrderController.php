<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * แสดงหน้า Checkout
     */
    public function create(Request $request)
    {
        // ดึง cart จาก session ให้รองรับทั้งแบบ:
        // 1) ['product_id' => qty, ...]
        // 2) [['product_id' => 1, 'qty' => 2], ...]
        $raw = collect(session('cart', []));

        $lines = $raw->map(function ($val, $key) {
            if (is_array($val) && isset($val['product_id'])) {
                return [
                    'product_id' => (int) $val['product_id'],
                    'qty'        => max(1, (int) ($val['qty'] ?? 1)),
                ];
            }
            // fallback: key = product_id, value = qty
            return [
                'product_id' => (int) $key,
                'qty'        => max(1, (int) $val),
            ];
        })->values();

        // ถ้าตะกร้าว่าง ให้กลับไปหน้าตะกร้า
        if ($lines->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Cart is empty');
        }

        $products = Product::with(['stock', 'brand', 'category'])
            ->whereIn('id', $lines->pluck('product_id'))
            ->get()
            ->keyBy('id');

        // ประกอบข้อมูลโชว์ในหน้า checkout
        $cartLines = $lines->map(function ($row) use ($products) {
            $p = $products->get($row['product_id']);
            if (!$p) return null;

            $price = (float) $p->price;
            $qty   = (int) $row['qty'];

            return [
                'product' => $p,
                'qty'     => $qty,
                'price'   => $price,
                'total'   => $price * $qty,
            ];
        })->filter()->values();

        $subtotal = $cartLines->sum('total');

        return view('checkout.create', [
            'cartLines' => $cartLines,
            'subtotal'  => $subtotal,
            // total = subtotal (ไม่มีค่าส่ง/ส่วนลด)
            'total'     => $subtotal,
            // เติมค่าพรีฟิลบางอย่างจากผู้ใช้ (แล้วแต่ระบบคุณ)
            'prefill'   => [
                'name'    => $request->user()->name ?? '',
                'phone'   => '',
                'addr1'   => '',
                'addr2'   => '',
                'district'=> '',
                'province'=> '',
                'postcode'=> '',
            ],
        ]);
    }

    /**
     * สร้างออเดอร์ (ยังไม่ต้องจ่าย) → สถานะ pending
     */
    public function store(Request $request)
    {
        // รับข้อมูลที่อยู่
        $data = $request->validate([
            'ship_name'     => ['required','string','max:255'],
            'ship_phone'    => ['required','string','max:50'],
            'ship_address1' => ['required','string','max:255'],
            'ship_address2' => ['nullable','string','max:255'],
            'ship_district' => ['required','string','max:255'],
            'ship_province' => ['required','string','max:255'],
            'ship_postcode' => ['required','string','max:20'],
        ]);

        $raw = collect(session('cart', []));
        $lines = $raw->map(function ($val, $key) {
            if (is_array($val) && isset($val['product_id'])) {
                return [
                    'product_id' => (int) $val['product_id'],
                    'qty'        => max(1, (int) ($val['qty'] ?? 1)),
                ];
            }
            return [
                'product_id' => (int) $key,
                'qty'        => max(1, (int) $val),
            ];
        })->values();

        abort_if($lines->isEmpty(), 400, 'Cart is empty');

        $products = Product::with(['stock'])
            ->whereIn('id', $lines->pluck('product_id'))
            ->get()
            ->keyBy('id');

        // คำนวณยอดรวม
        $subtotal = 0;
        $itemsForCreate = [];

        foreach ($lines as $row) {
            $p = $products->get($row['product_id']);
            if (!$p) continue;

            $price = (float) $p->price;
            $qty   = (int) $row['qty'];
            $lineTotal = $price * $qty;

            $subtotal += $lineTotal;

            $itemsForCreate[] = [
                'product_id' => $p->id,
                'name'       => $p->name,
                'price'      => $price,
                'qty'        => $qty,
                'total'      => $lineTotal,
            ];
        }

        abort_if($subtotal <= 0, 400, 'Invalid cart');

        // total = subtotal (ไม่มีค่าส่ง/ส่วนลด)
        $total = $subtotal;

        // ธุรกรรมเพื่อความปลอดภัย
        $order = DB::transaction(function () use ($request, $data, $itemsForCreate, $subtotal, $total) {
            /** @var \App\Models\Order $order */
            $order = Order::create([
    'user_id'        => $request->user()->id,
    'status'         => Order::STATUS_PENDING,
    'payment_method' => 'cod', // ✅ ตั้งค่าเริ่มต้นเป็น COD (ยังไม่ต้องจ่าย)
    'subtotal'       => $subtotal,
    'total'          => $total,

    'ship_name'      => $data['ship_name'],
    'ship_phone'     => $data['ship_phone'],
    'ship_address1'  => $data['ship_address1'],
    'ship_address2'  => $data['ship_address2'] ?? null,
    'ship_district'  => $data['ship_district'],
    'ship_province'  => $data['ship_province'],
    'ship_postcode'  => $data['ship_postcode'],
]);

            foreach ($itemsForCreate as $it) {
                OrderItem::create(array_merge($it, [
                    'order_id' => $order->id,
                ]));
            }

            // ถ้าต้องการตัด stock ภายหลังเมื่อแอดมินอนุมัติ ค่อยทำที่ flow หลังบ้าน
            // ตอนนี้ไม่ตัดสต็อก

            return $order;
        });

        // เคลียร์ตะกร้า
        session()->forget('cart');

        // ส่งไปหน้าแสดงออเดอร์ (หรือหน้าขอบคุณ)
        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Order placed. We will review it soon.');
    }

    /**
     * แสดงออเดอร์ของลูกค้า (ของเดิมมีอยู่แล้ว)
     */
    public function show(Request $request, Order $order)
{
    $user = $request->user();

    // อนุญาต: เจ้าของออเดอร์ หรือ admin/staff
    if (!($order->user_id === $user->id || $user->isAdmin() || $user->isStaff())) {
        abort(403);
    }

    $order->load(['items.product', 'user']);
    return view('orders.show', compact('order'));
}
}
