<?php

namespace App\Http\Controllers;

use App\Models\ContactChannel;

class ContactPageController extends Controller
{
    public function __invoke()
    {
        $channels = ContactChannel::where('is_active', true)
            ->orderBy('group')->orderBy('sort_order')->get()
            ->groupBy('group');

        return view('contact', compact('channels'));
    }
}
