<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // categories
        Schema::create('categories', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();
            $t->string('slug')->unique();
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        // brands
        Schema::create('brands', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();
            $t->string('slug')->unique();
            $t->timestamps();
        });

        // products
        Schema::create('products', function (Blueprint $t) {
    $t->id();

    // สร้างคอลัมน์ FK แบบแยก แล้วค่อยกำหนด foreign ชัดๆ ทีหลัง
    $t->unsignedBigInteger('category_id')->nullable();
    $t->unsignedBigInteger('brand_id')->nullable();

    $t->string('name');
    $t->string('sku')->unique()->nullable();
    $t->string('cover_image')->nullable();
    $t->decimal('price', 12, 2)->default(0);
    $t->enum('status', ['active','inactive'])->default('active');
    $t->timestamps();

    // index (ตั้งชื่อเองกันชน)
    $t->index('category_id', 'idx_products_category_id');
    $t->index('brand_id',    'idx_products_brand_id');

    // foreign keys (ตั้งชื่อชัดเจน)
    $t->foreign('category_id', 'fk_products_category')
      ->references('id')->on('categories')
      ->nullOnDelete();

    $t->foreign('brand_id', 'fk_products_brand')
      ->references('id')->on('brands')
      ->nullOnDelete();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('products');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
    }
};
