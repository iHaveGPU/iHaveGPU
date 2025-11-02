<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $t->string('number', 50)->nullable()->index(); // ให้ Model gen เอง
            $t->enum('status', ['pending','paid','shipped','cancelled'])->default('pending');
            $t->string('payment_method')->nullable(); // เผื่อ NULL

            $t->decimal('subtotal', 12, 2)->default(0);
            $t->decimal('shipping_fee', 12, 2)->default(0);
            $t->decimal('total', 12, 2)->default(0);

            // shipping snapshot
            $t->string('ship_name')->nullable();
            $t->string('ship_phone')->nullable();
            $t->string('ship_address1')->nullable();
            $t->string('ship_address2')->nullable();
            $t->string('ship_district')->nullable();
            $t->string('ship_province')->nullable();
            $t->string('ship_postcode', 10)->nullable();

            $t->timestamps();
        });

        Schema::create('order_items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $t->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();

            // snapshot
            $t->string('name', 255);
            $t->string('sku', 100)->nullable();
            $t->decimal('price', 12, 2);
            $t->unsignedInteger('qty');
            $t->decimal('subtotal', 12, 2);

            $t->timestamps();

            $t->index('order_id');
            $t->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
