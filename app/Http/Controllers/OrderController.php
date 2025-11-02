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
        // ----- ตะกร้าจาก session รองรับ 2 รูปแบบ -----
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

        if ($lines->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Cart is empty');
        }

        $products = Product::with(['stock','brand','category'])
            ->whereIn('id', $lines->pluck('product_id'))
            ->get()
            ->keyBy('id');

        // ประกอบรายการสำหรับโชว์
        $cartLines = $lines->map(function ($row) use ($products) {
            $p = $products->get($row['product_id']);
            if (!$p) return null;

            $price = (float) $p->price;
            $qty   = (int)   $row['qty'];

            return [
                'product' => $p,
                'qty'     => $qty,
                'price'   => $price,
                'total'   => $price * $qty,
            ];
        })->filter()->values();

        $subtotal = $cartLines->sum('total');

        // พรีฟิลจากโปรไฟล์ผู้ใช้
        $u = $request->user();
        $prefill = [
            'name'     => $u->name     ?? '',
            'phone'    => $u->phone    ?? '',
            'addr1'    => $u->address1 ?? '',
            'addr2'    => $u->address2 ?? '',
            'district' => $u->district ?? '',
            'province' => $u->province ?? '',
            'postcode' => $u->postcode ?? '',
        ];

        return view('checkout.create', [
            'prefill'   => $prefill,
            'cartLines' => $cartLines,
            'subtotal'  => $subtotal,
            'total'     => $subtotal, // ไม่มีค่าส่ง/ส่วนลด
        ]);
    }

    /**
     * บันทึกคำสั่งซื้อ (สถานะเริ่มต้น: pending)
     */
    public function store(Request $request)
    {
        // รับ/validate ที่อยู่จัดส่ง
        $data = $request->validate([
            'ship_name'     => ['required','string','max:255'],
            'ship_phone'    => ['required','string','max:50'],
            'ship_address1' => ['required','string','max:255'],
            'ship_address2' => ['nullable','string','max:255'],
            'ship_district' => ['required','string','max:255'],
            'ship_province' => ['required','string','max:255'],
            'ship_postcode' => ['required','string','max:20'],
        ]);

        // อ่านตะกร้าอีกครั้งจาก session (กัน user เปิดหลายแท็บ)
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

        $products = Product::with('stock')
            ->whereIn('id', $lines->pluck('product_id'))
            ->get()
            ->keyBy('id');

        // คำนวณยอด + เตรียมรายการสำหรับ OrderItem
        $subtotal = 0;
        $itemsForCreate = [];

        foreach ($lines as $row) {
            $p = $products->get($row['product_id']);
            if (!$p) continue;

            $price    = (float) $p->price;
            $qty      = (int)   $row['qty'];
            $lineSub  = $price * $qty;

            $subtotal += $lineSub;

            // **สำคัญ**: ให้ตรงกับ fillable/columns ของ OrderItem (subtotal)
            $itemsForCreate[] = [
                'product_id' => $p->id,
                'name'       => $p->name,
                'sku'        => $p->sku ?? null,
                'price'      => $price,
                'qty'        => $qty,
                'subtotal'   => $lineSub,
            ];
        }

        abort_if($subtotal <= 0, 400, 'Invalid cart');

        $total = $subtotal; // ไม่มีส่วนลด/ค่าส่ง

        // สร้างออเดอร์ + ไอเท็มในธุรกรรมเดียว
        $order = DB::transaction(function () use ($request, $data, $itemsForCreate, $subtotal, $total) {
            /** @var \App\Models\Order $order */
            $order = Order::create([
                'user_id'        => $request->user()->id,
                'status'         => Order::STATUS_PENDING,
                'payment_method' => 'cod',       // ค่าเริ่มต้น
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
                OrderItem::create($it + ['order_id' => $order->id]);
            }

            return $order;
        });

        // ล้างตะกร้า
        session()->forget('cart');

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Order placed. We will review it soon.');
    }

    /**
     * แสดงออเดอร์ของลูกค้า (หรือ staff/admin)
     */
    public function show(Request $request, Order $order)
    {
        $user = $request->user();

        // เจ้าของออเดอร์ หรือ admin/staff เท่านั้น
        if (!($order->user_id === $user->id || ($user->isAdmin() ?? false) || ($user->isStaff() ?? false))) {
            abort(403);
        }

        $order->load(['items.product','user']);

        return view('orders.show', compact('order'));
    }
}
