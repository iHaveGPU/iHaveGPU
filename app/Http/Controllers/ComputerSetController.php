<?php

namespace App\Http\Controllers;

use App\Models\ComputerSet;

class ComputerSetController extends Controller
{
    // รายการชุดสำเร็จ
    public function index()
    {
        $sets = ComputerSet::withCount('products')->latest()->paginate(12);
        return view('sets.index', compact('sets'));
    }

    // รายละเอียดชุด + สินค้าในชุด
    public function show(ComputerSet $set)
    {
        $set->load(['products' => function($q){ $q->with('stock'); }]);
        return view('sets.show', compact('set'));
    }
}
