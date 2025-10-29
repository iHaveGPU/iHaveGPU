<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();  // ลบสินค้าแล้วลบ stock ตาม
            $table->unsignedInteger('qty')->default(0);
            $table->timestamps();

            $table->unique('product_id'); // 1 product มี stock 1 แถว
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
