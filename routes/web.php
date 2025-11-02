<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers (Public)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ComputerSetController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Controllers (Auth / Customer)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Controllers (Admin / Staff)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController   as AdminOrderController;
use App\Http\Controllers\Admin\UserController    as AdminUserController;
use App\Http\Controllers\Admin\ComputerSetController as AdminComputerSetController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ContactChannelController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController   as AdminBrandController;

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('home');

Route::resource('products', ProductController::class)
    ->only(['index','show'])
    ->names(['index' => 'products.index', 'show' => 'products.show']);

Route::get('/sets', [ComputerSetController::class, 'index'])->name('sets.index');
Route::get('/sets/{set:slug}', [ComputerSetController::class, 'show'])->name('sets.show');

Route::get('/devices', fn () => redirect()->route('products.index'))->name('devices.index');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/contact', ContactPageController::class)->name('contact');

/*
|--------------------------------------------------------------------------
| Dashboard (Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |----------------------------------------------------------------------
    | Customer only
    |----------------------------------------------------------------------
    */
    Route::middleware([RoleMiddleware::class . ':customer'])->group(function () {
        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
        Route::patch('/cart/update/{product}', [CartController::class, 'updateQty'])->name('cart.update');

        // Add whole set to cart
        Route::post('/sets/{set}/add-to-cart', [CartController::class, 'addSet'])->name('cart.addSet');

        // Checkout & view own order
        Route::get('/checkout',  [OrderController::class, 'create'])->name('orders.create');
        Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    /*
    |----------------------------------------------------------------------
    | Staff + Admin (/manage)
    |  - products / categories / articles / sets / brands
    |  - orders: index/show/update/destroy (สิทธิ์ลบกรองใน Controller/Policy)
    |----------------------------------------------------------------------
    */
    Route::middleware([RoleMiddleware::class . ':staff,admin'])
        ->prefix('manage')->name('manage.')->group(function () {

            Route::resource('products',  AdminProductController::class);

            Route::resource('sets', AdminComputerSetController::class)
                ->parameters(['sets' => 'set'])
                ->names('sets');

            Route::resource('articles',  AdminArticleController::class);

            Route::resource('categories', AdminCategoryController::class)
                ->parameters(['categories' => 'category'])
                ->names('categories');

            // ให้ staff จัดการ brands ได้ด้วย
            Route::resource('brands', AdminBrandController::class);

            // Orders สำหรับ staff+admin (destroy จะถูกบล็อกถ้าไม่ใช่ admin ใน Controller/Policy)
            Route::resource('orders', AdminOrderController::class)
                ->only(['index','show','update','destroy']);

            // (ออปชัน) ปุ่มเปลี่ยนสถานะแบบเร็ว
            Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
                ->name('orders.updateStatus');
        });

    // Staff Dashboard (optional)
    Route::middleware([RoleMiddleware::class . ':staff,admin'])
        ->get('/staff', fn () => view('staff.dashboard'))
        ->name('staff.dashboard');

    /*
    |----------------------------------------------------------------------
    | Admin only
    |  - users / contacts
    |  (อย่าประกาศ brands หรือ orders ซ้ำ)
    |----------------------------------------------------------------------
    */
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/admin', fn () => view('admin.dashboard'))->name('admin.dashboard');

        Route::prefix('manage')->name('manage.')->group(function () {
            Route::resource('users',    AdminUserController::class)->only(['index','edit','update','destroy']);

            Route::resource('contacts', ContactChannelController::class)
                ->parameters(['contacts' => 'contact'])
                ->names('contacts');
        });
    });
});

require __DIR__ . '/auth.php';
