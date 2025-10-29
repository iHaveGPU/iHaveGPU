<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComputerSet;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ComputerSetController extends Controller
{
    /**
     * รายการเซ็ต
     */
    public function index()
    {
        $sets = ComputerSet::withCount('products')
            ->latest()
            ->paginate(15);

        return view('admin.sets.index', compact('sets'));
    }

    /**
     * ฟอร์มสร้างเซ็ต
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('admin.sets.create', [
            'set'          => new ComputerSet(),
            'products'     => $products,
            'selected'     => [],   // product id ที่ถูกเลือก
            'selectedQty'  => [],   // qty ของแต่ละ product id
        ]);
    }

    /**
     * บันทึกสร้างเซ็ตใหม่
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:255'],
            'slug'          => ['nullable','string','max:255','unique:computer_sets,slug'],
            'description'   => ['nullable','string'],
            'cover_image'   => ['nullable','image','max:2048'], // รูปหน้าปกของชุด
            'product_ids'   => ['array'],
            'product_ids.*' => ['integer','exists:products,id'],
            'qtys'          => ['array'],
        ]);

        // ถ้าไม่ส่ง slug มา ให้ gen จาก name และกันซ้ำอีกชั้น
        $slug = $data['slug'] ?? Str::slug($data['name']);
        if (ComputerSet::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        // อัปโหลดรูป (ถ้ามี)
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('sets', 'public');
        }

        $set = ComputerSet::create([
            'name'        => $data['name'],
            'slug'        => $slug,
            'description' => $data['description'] ?? null,
            'cover_image' => $coverPath,
        ]);

        // แนบสินค้า + qty ลง pivot
        $productIds = $data['product_ids'] ?? [];
        $qtys       = $data['qtys'] ?? [];
        $sync       = [];

        foreach ($productIds as $pid) {
            $q = max(1, (int)($qtys[$pid] ?? 1));
            $sync[$pid] = ['qty' => $q];
        }
        $set->products()->sync($sync);

        return redirect()->route('manage.sets.index')->with('success', 'Set created.');
    }

    /**
     * ฟอร์มแก้ไขเซ็ต
     */
    public function edit(ComputerSet $set)
    {
        $products    = Product::orderBy('name')->get();
        $selected    = $set->products()->pluck('products.id')->all();          // [1,3,5]
        $selectedQty = $set->products->pluck('pivot.qty', 'id')->all();        // ['1'=>2, '3'=>1]

        return view('admin.sets.edit', compact('set','products','selected','selectedQty'));
    }

    /**
     * บันทึกแก้ไขเซ็ต
     */
    public function update(Request $request, ComputerSet $set)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:255'],
            'slug'          => ['nullable','string','max:255', Rule::unique('computer_sets','slug')->ignore($set->id)],
            'description'   => ['nullable','string'],
            'cover_image'   => ['nullable','image','max:2048'],
            'product_ids'   => ['array'],
            'product_ids.*' => ['integer','exists:products,id'],
            'qtys'          => ['array'],
        ]);

        $slug = $data['slug'] ?? Str::slug($data['name']);

        // อัปโหลดรูปใหม่ (ถ้ามี) และลบของเก่า
        if ($request->hasFile('cover_image')) {
            if ($set->cover_image) {
                Storage::disk('public')->delete($set->cover_image);
            }
            $set->cover_image = $request->file('cover_image')->store('sets', 'public');
        }

        $set->name        = $data['name'];
        $set->slug        = $slug;
        $set->description = $data['description'] ?? null;
        $set->save();

        // sync pivot
        $productIds = $data['product_ids'] ?? [];
        $qtys       = $data['qtys'] ?? [];
        $sync       = [];

        foreach ($productIds as $pid) {
            $q = max(1, (int)($qtys[$pid] ?? 1));
            $sync[$pid] = ['qty' => $q];
        }
        $set->products()->sync($sync);

        return redirect()->route('manage.sets.index')->with('success', 'Set updated.');
    }

    /**
     * ลบเซ็ต
     */
    public function destroy(ComputerSet $set)
    {
        if ($set->cover_image) {
            Storage::disk('public')->delete($set->cover_image);
        }

        // ลบความสัมพันธ์ pivot แล้วลบตัวเซ็ต
        $set->products()->detach();
        $set->delete();

        return back()->with('success', 'Set deleted.');
    }
}
