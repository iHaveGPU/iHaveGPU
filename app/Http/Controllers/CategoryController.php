<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // แสดงรายการหมวดหมู่ (ถ้าอยากมีหน้าแยก)
    public function index()
    {
        $categories = Category::active()->get();
        return view('categories.index', compact('categories'));
    }

    // แสดงสินค้าในหมวด
    public function show(Category $category)
    {
        $products = $category->products()->latest()->paginate(12);
        $categories = Category::active()->get(); // สำหรับ sidebar
        return view('products.index', compact('products', 'categories', 'category'));
    }
}
