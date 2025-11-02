<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ComputerSet;

class CartController extends Controller
{
    /**
     * แสดงตะกร้า
     * โครงสร้าง session: ['cart' => [product_id => qty]]
     */
    public function index()
    {
        $cart  = session('cart', []); // [product_id => qty]

        if (empty($cart)) {
            $lines = collect();
            $total = 0;
            return view('cart.index', compact('lines', 'total'));
        }

        // ดึงสินค้าที่มีในตะกร้า
        $items = Product::with('stock')->whereIn('id', array_keys($cart))->get();

        $lines = $items->map(function (Product $p) use ($cart) {
            $qty = (int) ($cart[$p->id] ?? 0);
            return [
                'product'  => $p,
                'qty'      => $qty,
                'subtotal' => $qty * (float) $p->price,
            ];
        });

        $total = $lines->sum('subtotal');

        return view('cart.index', compact('lines', 'total'));
    }

    /**
     * เพิ่มสินค้าเดี่ยวลงตะกร้า
     * - redirect กลับหน้า /products ตามที่ตั้งใจไว้ก่อนหน้า
     */
    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->input('qty', 1));
         $product->loadMissing('stock');

         //ไม่มีสต๊อก
         if(($product->stock_qty ?? 0) < 1){
            return back()->withErrors(['cart' => 'สินค้าหมด ไม่สามารถเพิ่มลงตะกร้าได้.']);
         }
            //สต๊อกไม่พอ
            if(($product->stock_qty ?? 0) < $qty){
                return back()->withErrors(['cart' => 'สินค้าสต๊อกไม่เพียงพอ.']);
        }
        $cart = session('cart', []);
        $cart[$product->id] = (int) (($cart[$product->id] ?? 0) + $qty);
        session(['cart' => $cart]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Added to cart');
    }

    /**
     * เอาสินค้าออกจากตะกร้า
     */
    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Removed from cart');
    }

    /**
     * อัปเดตจำนวนในตะกร้า (0 = เอาออก)
     */
    public function updateQty(Request $request, Product $product)
    {
        $qty  = max(0, (int) $request->input('qty', 0));
        $cart = session('cart', []);

        if ($qty === 0) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = $qty;
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Updated');
    }

    /**
     * เพิ่ม "ทั้งชุด" (ComputerSet) ลงตะกร้า แบบ all-or-nothing
     * - ใช้ route model binding {set:slug} ให้แน่ใจว่าในโมเดล ComputerSet
     *   มี getRouteKeyName() ที่คืนค่า 'slug'
     */
    public function addSet(Request $request, ComputerSet $set)
    {
        // จำนวนชุดที่ลูกค้าเลือก (ขั้นต่ำ 1)
        $multiplier = max(1, (int) $request->input('set_qty', 1));

        // โหลดสินค้าในชุด พร้อม stock (ถ้ามี)
        $set->load(['products' => function ($q) {
            $q->with('stock'); // ต้องมี relation stock ใน Product
        }]);

        if ($set->products->isEmpty()) {
            return back()->withErrors(['cart' => 'This set has no products.']);
        }

        $cart = session('cart', []); // [product_id => qty]
        $insufficient = [];

        // ตรวจสต็อก: ถ้า product ไหนไม่พอ ให้ fail ทั้งชุด
        foreach ($set->products as $p) {
            $baseQty   = (int) ($p->pivot->qty ?? 1);          // จำนวนต่อ 1 ชุด
            $need      = $baseQty * $multiplier;               // จำนวนรวมตามชุดที่เลือก
            $inCart    = (int) ($cart[$p->id] ?? 0);
            $available = optional($p->stock)->qty;             // null = ไม่ได้ track สต็อก

            if (!is_null($available)) {
                $remaining = $available - $inCart;
                if ($need > $remaining) {
                    $insufficient[] = "{$p->name} (need {$need}, available " . max(0, $remaining) . ")";
                }
            }
        }

        if (!empty($insufficient)) {
            return back()->withErrors([
                'cart' => 'Not enough stock for: ' . implode(', ', $insufficient),
            ]);
        }

        // ผ่านการเช็กสต็อก: เพิ่มลงตะกร้า
        foreach ($set->products as $p) {
            $need = (int) (($p->pivot->qty ?? 1) * $multiplier);
            $cart[$p->id] = (int) (($cart[$p->id] ?? 0) + $need);
        }

        session(['cart' => $cart]);

        return redirect()
            ->route('cart')
            ->with('success', "Added set '{$set->name}' x{$multiplier} to your cart.");
    }
}
