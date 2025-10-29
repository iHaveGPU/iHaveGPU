<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show register form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->string('name'),
            'email'    => $request->string('email')->lower(),
            'password' => Hash::make($request->input('password')),
            'role'     => 'customer', // ค่าเริ่มต้นเป็นลูกค้า
        ]);

        event(new Registered($user));

        Auth::login($user);
        // กลับไปหน้าที่ตั้งใจไว้ก่อนสมัคร (ถ้ามี) ไม่มีก็หน้าแรก
        return redirect()->intended(route('home'));
    }
}
