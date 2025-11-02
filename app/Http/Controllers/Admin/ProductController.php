<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * รายการสินค้า (หลังบ้าน)
     */
    public function index()
    {
        $products = Product::with(['category', 'brand', 'stock'])
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    /**
     * ฟอร์มสร้างสินค้าใหม่
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();

        // ส่ง product ว่าง ๆ ไป (ยังไม่มี attributes/stock)
        return view('admin.products.create', [
            'product'    => new Product(),
            'categories' => $categories,
            'brands'     => $brands,
        ]);
    }

    /**
     * บันทึกสินค้าใหม่
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'sku'         => ['nullable','string','max:100','unique:products,sku'],
            'price'       => ['required','numeric','min:0'],
            'status'      => ['required','in:active,inactive'],
            'category_id' => ['nullable','exists:categories,id'],
            'brand_id'    => ['nullable','exists:brands,id'],
            'qty'         => ['nullable','integer','min:0'],
            'cover_image' => ['nullable','image','max:2048'],

            // attributes[]
            'attributes'                  => ['array'],
            'attributes.*.name'           => ['required','string','max:255'],
            'attributes.*.value'          => ['nullable','string','max:1000'],
            'attributes.*.sort_order'     => ['nullable','integer','min:0'],
        ]);

        // อัปโหลดปก (ถ้ามี)
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('products', 'public'); // storage/app/public/products/xxx.png
        }

        // สร้างสินค้า
        $product = Product::create([
    'name'        => $data['name'],
    'sku'         => $data['sku'] ?? null,
    'price'       => $data['price'],
    'status'      => $data['status'],
    'category_id' => $data['category_id'] ?? null,
    'brand_id'    => $data['brand_id'] ?? null,
    'cover_image' => $data['cover_image'] ?? null, // <- เก็บพาธสัมพัทธ์ของ disk public
]);

        // สต็อกเริ่มต้น (ถ้ามี)
        if (array_key_exists('qty', $data)) {
            Stock::updateOrCreate(['product_id' => $product->id], ['qty' => (int) $data['qty']]);
        }

        // บันทึก attributes (ข้ามแถวที่เว้น name ว่าง)
        $attrs = collect($request->input('attributes', []))
            ->filter(fn ($row) => filled($row['name'] ?? null))
            ->values();

        foreach ($attrs as $i => $row) {
            $product->attributes()->create([
                'name'       => $row['name'],
                'value'      => $row['value'] ?? '',
                'sort_order' => $row['sort_order'] ?? $i,
            ]);
        }

        return redirect()->route('manage.products.index')->with('success', 'Product created');
    }

    /**
     * ฟอร์มแก้ไขสินค้า
     */
    public function edit(Product $product)
    {
        $product->load('attributes', 'stock', 'brand', 'category');

        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * อัปเดตสินค้า
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'sku'         => ['nullable','string','max:100', Rule::unique('products','sku')->ignore($product->id)],
            'price'       => ['required','numeric','min:0'],
            'status'      => ['required','in:active,inactive'],
            'category_id' => ['nullable','exists:categories,id'],
            'brand_id'    => ['nullable','exists:brands,id'],
            'qty'         => ['nullable','integer','min:0'],
            'cover_image' => ['nullable','image','max:2048'],

            'attributes'              => ['array'],
            'attributes.*.name'       => ['required','string','max:255'],
            'attributes.*.value'      => ['nullable','string','max:1000'],
            'attributes.*.sort_order' => ['nullable','integer','min:0'],
        ]);

        // อัปโหลดปกใหม่ (ลบรูปเก่า)
       if ($request->hasFile('cover_image')) {
    if ($product->cover_image && \Illuminate\Support\Str::startsWith($product->cover_image, ['products/', 'uploads/', 'images/']) ) {
        // ลบทิ้งเฉพาะไฟล์ที่อยู่บน disk public (กันพลาดสำหรับรูปที่มาจาก seeder จะไม่ลบไฟล์ใต้ public/images)
        \Storage::disk('public')->delete($product->cover_image);
    }

    $data['cover_image'] = $request->file('cover_image')->store('products', 'public');
}

        // อัปเดตข้อมูลหลัก
        $product->update([
    'name'        => $data['name'],
    'sku'         => $data['sku'] ?? null,
    'price'       => $data['price'],
    'status'      => $data['status'],
    'category_id' => $data['category_id'] ?? null,
    'brand_id'    => $data['brand_id'] ?? null,
    'cover_image' => $data['cover_image'] ?? $product->cover_image,
]);

        // อัปเดต stock
        if (array_key_exists('qty', $data)) {
            Stock::updateOrCreate(['product_id' => $product->id], ['qty' => (int) $data['qty']]);
        }

        // แทนที่ attributes ทั้งหมดแบบง่ายสุด
        $product->attributes()->delete();

        $attrs = collect($request->input('attributes', []))
            ->filter(fn ($row) => filled($row['name'] ?? null))
            ->values();

        foreach ($attrs as $i => $row) {
            $product->attributes()->create([
                'name'       => $row['name'],
                'value'      => $row['value'] ?? '',
                'sort_order' => $row['sort_order'] ?? $i,
            ]);
        }

        return redirect()->route('manage.products.index')->with('success', 'Product updated');
    }

    /**
     * ลบสินค้า
     */
    public function destroy(Product $product)
    {
        if ($product->cover_image) {
            Storage::disk('public')->delete($product->cover_image);
        }

        $product->delete();

        return redirect()->route('manage.products.index')->with('success', 'Product deleted');
    }

    /**
     * (ตัวเลือก) แสดงรายละเอียดสินค้า
     */
    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'stock', 'attributes']);
        return view('admin.products.show', compact('product'));
    }
}
