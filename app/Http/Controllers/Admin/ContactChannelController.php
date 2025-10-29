<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactChannel;
use Illuminate\Http\Request;

class ContactChannelController extends Controller
{
    public function index()
    {
        $channels = ContactChannel::orderBy('group')
            ->orderBy('sort_order')
            ->paginate(30);

        return view('admin.contacts.index', compact('channels'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'group'      => 'required|string|max:50',
            'type'       => 'required|string|max:20',
            'label'      => 'required|string|max:255',
            'value'      => 'nullable|string|max:255',
            'url'        => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);

        $data['is_active'] = (bool)($data['is_active'] ?? true);

        ContactChannel::create($data);

        return redirect()->route('manage.contacts.index')->with('success', 'Contact channel created.');
    }

    public function edit(ContactChannel $contact)
    {
        return view('admin.contacts.edit', ['channel' => $contact]);
    }

    public function update(Request $request, ContactChannel $contact)
    {
        $data = $request->validate([
            'group'      => 'required|string|max:50',
            'type'       => 'required|string|max:20',
            'label'      => 'required|string|max:255',
            'value'      => 'nullable|string|max:255',
            'url'        => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);

        $data['is_active'] = (bool)($data['is_active'] ?? false);

        $contact->update($data);

        return redirect()->route('manage.contacts.index')->with('success', 'Contact channel updated.');
    }

    public function destroy(ContactChannel $contact)
    {
        $contact->delete();

        return back()->with('success', 'Contact channel deleted.');
    }
}
