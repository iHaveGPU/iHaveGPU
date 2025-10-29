<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // แสดงรายการผู้ใช้
    public function index()
    {
        $users = User::query()
            ->orderBy('id', 'asc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    // ฟอร์มแก้ไข (ให้เปลี่ยนได้เฉพาะ role)
    public function edit(User $user)
    {
        // ไม่บังคับ แต่แนะนำ: กันไม่ให้แก้ role ตัวเอง (ถ้าต้องการ)
        if (auth()->id() === $user->id) {
            return redirect()->route('manage.users.index')
                ->with('error', 'You cannot change your own role.');
        }

        $roles = ['admin' => 'Admin', 'staff' => 'Staff', 'customer' => 'Customer'];
        return view('admin.users.edit', compact('user','roles'));
    }

    // อัปเดต (เฉพาะ role)
    public function update(Request $request, User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('manage.users.index')
                ->with('error', 'You cannot change your own role.');
        }

        $validated = $request->validate([
            'role' => ['required', Rule::in(['admin','staff','customer'])],
        ]);

        $user->update(['role' => $validated['role']]);

        return redirect()->route('manage.users.index')
            ->with('success', "Updated role for {$user->name} to {$validated['role']}.");
    }

    // ลบผู้ใช้
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('manage.users.index')
            ->with('success', 'User deleted.');
    }
}
