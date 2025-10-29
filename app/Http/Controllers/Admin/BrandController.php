<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /** รายการแบรนด์ */
    public function index()
    {
        $brands = Brand::orderBy('name')->paginate(20);
        return view('admin.brands.index', compact('brands'));
    }

    /** ฟอร์มสร้างแบรนด์ */
    public function create()
    {
        // ส่ง $brand ว่าง ๆ ไปใช้กับ partial _form ได้
        return view('admin.brands.create', ['brand' => new Brand()]);
    }

    /** บันทึกแบรนด์ใหม่ */
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => ['required','string','max:255','unique:brands,name'],
        'slug' => ['nullable','string','max:255','unique:brands,slug'],
        'logo' => ['nullable','image','max:2048'], // ✅ รับไฟล์รูป
    ]);

    $data['slug'] = $data['slug'] ?: \Illuminate\Support\Str::slug($data['name']);

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('brands', 'public'); // เก็บที่ storage/app/public/brands
    }

    Brand::create($data);

    return redirect()->route('manage.brands.index')->with('success','Brand created');
}


    /** ฟอร์มแก้ไขแบรนด์ */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /** อัปเดตแบรนด์ */
   public function update(Request $request, Brand $brand)
{
    $data = $request->validate([
        'name' => ['required','string','max:255', Rule::unique('brands','name')->ignore($brand->id)],
        'slug' => ['nullable','string','max:255', Rule::unique('brands','slug')->ignore($brand->id)],
        'logo' => ['nullable','image','max:2048'],
    ]);

    $data['slug'] = $data['slug'] ?: \Illuminate\Support\Str::slug($data['name']);

    if ($request->hasFile('logo')) {
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo); // ลบไฟล์เก่า
        }
        $data['logo'] = $request->file('logo')->store('brands', 'public');
    }

    $brand->update($data);

    return redirect()->route('manage.brands.index')->with('success','Brand updated');
}


    /** ลบแบรนด์ */
    public function destroy(Brand $brand)
{
    if (method_exists($brand, 'products') && $brand->products()->exists()) {
        return back()->with('error','Cannot delete: this brand is used by products.');
    }
    if ($brand->logo) {
        Storage::disk('public')->delete($brand->logo);
    }
    $brand->delete();
    return back()->with('success','Brand deleted');
}

}
