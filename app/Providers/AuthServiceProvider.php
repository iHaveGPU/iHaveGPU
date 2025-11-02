<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Map policies to models (ถ้ามี Policy แยกเป็นไฟล์ ให้ map ที่นี่)
     */
    protected $policies = [
        // \App\Models\Product::class      => \App\Policies\ProductPolicy::class,
        // \App\Models\Order::class        => \App\Policies\OrderPolicy::class,
        // \App\Models\Article::class      => \App\Policies\ArticlePolicy::class,
        // \App\Models\ComputerSet::class  => \App\Policies\ComputerSetPolicy::class,
        // \App\Models\ContactChannel::class => \App\Policies\ContactChannelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /**
         * Admin ผ่านทุก Gate โดยไม่ต้องเช็คอย่างอื่น
         * ถ้าไม่ใช่ admin ให้ return null เพื่อไปเช็ค gate ตามปกติ
         */
        Gate::before(function (User $user, string $ability) {
            return $user->isAdmin() ? true : null;
        });

        /*
        |--------------------------------------------------------------------------
        | Product Gates  (staff สามารถดู/เพิ่ม/แก้ไข, ลบได้เฉพาะ admin)
        |--------------------------------------------------------------------------
        */
        Gate::define('product.viewAny', fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('product.view',    fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('product.create',  fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('product.update',  fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('product.delete',  fn (User $u) => $u->isAdmin());

        /*
        |--------------------------------------------------------------------------
        | Order Gates (staff+admin ดู/อัปเดตสถานะ, ลบได้เฉพาะ admin)
        |--------------------------------------------------------------------------
        */
        Gate::define('order.viewAny', fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('order.view',    fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('order.update',  fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('order.delete',  fn (User $u) => $u->isAdmin());

        /*
        |--------------------------------------------------------------------------
        | Article Gates (บทความ: staff+admin จัดการได้ ยกเว้นลบให้ admin เท่านั้น)
        |--------------------------------------------------------------------------
        */
        Gate::define('article.viewAny', fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('article.view',    fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('article.create',  fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('article.update',  fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('article.delete',  fn (User $u) => $u->isAdmin());

        /*
        |--------------------------------------------------------------------------
        | Computer Set Gates (ชุดสินค้า: staff+admin จัดการได้, ลบเฉพาะ admin)
        |--------------------------------------------------------------------------
        */
        Gate::define('set.viewAny', fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('set.view',    fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('set.create',  fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('set.update',  fn (User $u) => $u->isStaff() || $u->isAdmin());
        Gate::define('set.delete',  fn (User $u) => $u->isAdmin());

        /*
        |--------------------------------------------------------------------------
        | Contact Channel Gates (ช่องทางติดต่อ: ให้แก้เฉพาะ admin)
        |--------------------------------------------------------------------------
        */
        Gate::define('contact.viewAny', fn (User $u) => $u->isAdmin());
        Gate::define('contact.view',    fn (User $u) => $u->isAdmin());
        Gate::define('contact.create',  fn (User $u) => $u->isAdmin());
        Gate::define('contact.update',  fn (User $u) => $u->isAdmin());
        Gate::define('contact.delete',  fn (User $u) => $u->isAdmin());
    }

    /**
     * Register container bindings if needed.
     */
    public function register(): void
    {
        //
    }
    protected $policies = [
    \App\Models\Brand::class => \App\Policies\BrandPolicy::class,
];

}
