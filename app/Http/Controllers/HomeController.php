<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredProducts = Product::with(['brand','category'])
            ->where('status','active')
            ->latest()
            ->take(8)
            ->get();

        $topCategories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(8)
            ->get();

        // ถ้ายังไม่มีตาราง brands ให้ใส่ [] ไปก่อน
        $brands = class_exists(Brand::class)
            ? Brand::orderBy('name')->take(8)->get()
            : collect();

        return view('home', compact('featuredProducts','topCategories','brands'));
    }
}
