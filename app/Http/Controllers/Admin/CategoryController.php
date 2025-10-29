<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.categories.index', compact('cats'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required','string','max:255'],
            'slug'       => ['nullable','string','max:255','unique:categories,slug'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active'  => ['nullable','boolean'],
        ]);

        // สร้าง slug อัตโนมัติถ้าไม่ได้ส่งมา
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['name']);
        }
        $data['is_active']  = (bool)($data['is_active'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Category::create($data);

        return redirect()->route('manage.categories.index')
            ->with('success','Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'       => ['required','string','max:255'],
            'slug'       => ['nullable','string','max:255','unique:categories,slug,'.$category->id],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active'  => ['nullable','boolean'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['name']);
        }
        $data['is_active']  = (bool)($data['is_active'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $category->update($data);

        return redirect()->route('manage.categories.index')
            ->with('success','Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('manage.categories.index')
            ->with('success','Category deleted.');
    }
}