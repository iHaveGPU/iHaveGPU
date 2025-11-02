<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // GET /checkout
    public function create(Request $request)
    {
        $user = $request->user();

        // ดึงตะกร้าจาก session (ปรับตามที่คุณเก็บได้)
        $cart = collect(session('cart', [])); // [{product_id, name, price, qty}, ...]
        $subtotal = $cart->sum(fn ($row) => (float)$row['price'] * (int)$row['qty']);

        // ค่าเริ่มต้นจากโปรไฟล์ (ใช้เป็น both placeholder + value)
        $defaults = [
            'ship_name'     => $user->name ?? '',
            'ship_phone'    => $user->phone ?? '',
            'ship_address1' => $user->address1 ?? '',
            'ship_address2' => $user->address2 ?? '',
            'ship_district' => $user->district ?? '',
            'ship_province' => $user->province ?? '',
            'ship_postcode' => $user->postcode ?? '',
        ];

        // ใช้วิวตาม resource create
        return view('orders.create', compact('cart', 'subtotal', 'defaults'));
    }

    // POST /checkout
    public function store(Request $request)
    {
        $data = $request->validate([
            'ship_name'     => ['required','string','max:255'],
            'ship_phone'    => ['nullable','string','max:50'],
            'ship_address1' => ['required','string','max:255'],
            'ship_address2' => ['nullable','string','max:255'],
            'ship_district' => ['required','string','max:120'],
            'ship_province' => ['required','string','max:120'],
            'ship_postcode' => ['required','string','max:10'],
        ]);

        $user = $request->user();
        $cart = collect(session('cart', []));
        abort_if($cart->isEmpty(), 400, 'Cart is empty');

        return DB::transaction(function () use ($user, $cart, $data) {
            // คำนวณยอด
            $subtotal = $cart->sum(fn ($row) => (float)$row['price'] * (int)$row['qty']);

            // สร้างออเดอร์ (total = subtotal ในระบบนี้)
            $order = Order::create(array_merge($data, [
                'user_id'  => $user->id,
                'status'   => Order::STATUS_PENDING,
                'subtotal' => $subtotal,
                'total'    => $subtotal,
            ]));

            // สร้างรายการสินค้า
            foreach ($cart as $row) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'product_id'=> $row['product_id'] ?? null,
                    'name'      => $row['name'] ?? '-',
                    'sku'       => $row['sku'] ?? null,
                    'price'     => (float)$row['price'],
                    'qty'       => (int)$row['qty'],
                    'subtotal'  => (float)$row['price'] * (int)$row['qty'],
                ]);
            }

            // เคลียร์ตะกร้า
            session()->forget('cart');

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed.');
        });
    }

    // GET /orders/{order}
    public function show(Order $order)
    {
        $this->authorize('view', $order); // ถ้ามี Policy
        $order->load(['items.product','user']);
        return view('orders.show', compact('order'));
    }
}
