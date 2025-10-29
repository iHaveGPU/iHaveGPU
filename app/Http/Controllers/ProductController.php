<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * หน้าแสดงรายการสินค้า (Public) + ค้นหา/ฟิลเตอร์
     */
    public function index(Request $request)
    {
        $q = Product::query()
            ->with(['brand','category'])   // โหลด brand ด้วยเพื่อโชว์ในการ์ด
            ->where('status', 'active');

        // คำค้น (ชื่อ / SKU)
        if ($search = trim((string) $request->get('q', ''))) {
            $q->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // ฟิลเตอร์หมวดหมู่ (?category=slug)
        $category = null;
        if ($slug = $request->get('category')) {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                $q->where('category_id', $category->id);
            }
        }

        // ฟิลเตอร์ช่วงราคา (ออปชัน)
        if ($min = $request->input('min')) {
            $q->where('price', '>=', (float) $min);
        }
        if ($max = $request->input('max')) {
            $q->where('price', '<=', (float) $max);
        }

        $products = $q->latest()
            ->paginate(12)
            ->appends($request->only('q','category','min','max'));

        $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products','categories','category'));
    }

    /**
     * หน้าแสดงรายละเอียดสินค้า (Public)
     */
    public function show(Product $product)
    {
        // ถ้าไม่ active ให้ 404
        abort_if($product->status !== 'active', 404);

        // โหลดความสัมพันธ์ที่ต้องใช้บนหน้า show
        $product->load([
            'brand',
            'category',
            'stock',
            'attributes' => fn($q) => $q->orderBy('sort_order')->orderBy('name'),
        ]);

        return view('products.show', compact('product'));
    }

    // ปิดเมธอดที่ไม่ใช้ใน public
    public function create()                       { abort(404); }
    public function store(Request $request)        { abort(404); }
    public function edit(Product $product)         { abort(404); }
    public function update(Request $r, Product $p) { abort(404); }
    public function destroy(Product $product)      { abort(404); }
}
