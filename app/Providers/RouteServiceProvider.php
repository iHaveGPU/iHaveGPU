<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * เส้นทางที่จะ redirect หลังล็อกอิน/สมัครสำเร็จ
     * (ถูกใช้โดย RedirectIfAuthenticated / Auth controllers)
     */
    public const HOME = '/';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ผูก alias middleware 'role'
        app('router')->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);

        // Rate limiter ตัวอย่าง (เหมือนค่าเริ่มต้นของ Laravel)
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // โหลดไฟล์ routes
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
