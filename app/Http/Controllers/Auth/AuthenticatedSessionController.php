<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login form.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // เลือกปลายทาง fallback ตาม role ถ้าไม่มี intended URL
        $user = $request->user();
        $fallback = match ($user->role ?? null) {
            'admin' => route('admin.dashboard'),
            'staff' => route('manage.products.index'),
            default => route('home'),
        };

        // กลับไปหน้าที่ตั้งใจไว้ก่อนล็อกอิน (ถ้ามี) ไม่มีก็ไป fallback
        return redirect()->intended($fallback);
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // ออกจากระบบแล้วกลับหน้าแรก
    }
}
