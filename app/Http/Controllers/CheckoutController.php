<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // แสดงหน้า checkout
    public function show(Request $request)
    {
        $user = $request->user();

        // ตัวอย่างตะกร้า: ดึงจาก session หรือ service ของคุณ
        $cart = session('cart', []); // [['product_id'=>1,'name'=>'','price'=>0,'qty'=>1], ...]
        $subtotal = collect($cart)->sum(fn($r) => ($r['price'] ?? 0) * ($r['qty'] ?? 1));

        // map ค่าจากโปรไฟล์มาเป็น default สำหรับ shipping
        $defaults = [
            'ship_name'     => $user->name ?? '',
            'ship_phone'    => $user->phone ?? '',
            'ship_address1' => $user->address1 ?? '',
            'ship_address2' => $user->address2 ?? '',
            'ship_district' => $user->district ?? '',
            'ship_province' => $user->province ?? '',
            'ship_postcode' => $user->postcode ?? '',
        ];

        return view('checkout', compact('cart','subtotal','defaults'));
    }

    // วางออเดอร์
    public function place(Request $request)
    {
        $data = $request->validate([
            'ship_name'     => ['required','string','max:255'],
            'ship_phone'    => ['nullable','string','max:50'],
            'ship_address1' => ['required','string','max:255'],
            'ship_address2' => ['nullable','string','max:255'],
            'ship_district' => ['nullable','string','max:120'],
            'ship_province' => ['nullable','string','max:120'],
            'ship_postcode' => ['nullable','string','max:10'],
        ]);

        $cart = session('cart', []);
        abort_if(empty($cart), 400, 'Cart is empty.');

        $order = Order::create([
            'user_id'       => $request->user()->id,
            'status'        => Order::STATUS_PENDING,
            'ship_name'     => $data['ship_name'],
            'ship_phone'    => $data['ship_phone'] ?? null,
            'ship_address1' => $data['ship_address1'],
            'ship_address2' => $data['ship_address2'] ?? null,
            'ship_district' => $data['ship_district'] ?? null,
            'ship_province' => $data['ship_province'] ?? null,
            'ship_postcode' => $data['ship_postcode'] ?? null,
            'subtotal'      => 0,
            'total'         => 0,
        ]);

        foreach ($cart as $row) {
            $order->items()->create([
                'product_id' => $row['product_id'] ?? null,
                'name'       => $row['name'] ?? 'Product',
                'sku'        => $row['sku']  ?? null,
                'price'      => $row['price'] ?? 0,
                'qty'        => $row['qty'] ?? 1,
                'subtotal'   => ($row['price'] ?? 0) * ($row['qty'] ?? 1),
            ]);
        }

        $order->recalcTotals();

        // เคลียร์ตะกร้า
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed!');
    }
}
