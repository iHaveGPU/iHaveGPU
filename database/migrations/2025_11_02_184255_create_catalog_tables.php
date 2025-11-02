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
            $t->string('logo_path')->nullable(); // เก็บโลโก้ (ถ้าใช้)
            $t->timestamps();
        });

        // products
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $t->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $t->string('name');
            $t->string('sku')->unique()->nullable();
            $t->string('cover_image')->nullable();     // ใช้ร่วมกับ UI ปัจจุบัน
            $t->decimal('price', 12, 2)->default(0);
            $t->enum('status', ['active','inactive'])->default('active');
            $t->timestamps();

            $t->index('category_id');
            $t->index('brand_id');
        });

        // stocks
        Schema::create('stocks', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $t->unsignedInteger('qty')->default(0);
            $t->timestamps();
            $t->unique('product_id'); // 1 product = 1 แถว stock
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
