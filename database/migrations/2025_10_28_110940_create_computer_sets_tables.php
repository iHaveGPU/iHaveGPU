<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('computer_sets', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->string('cover_image')->nullable();
            $t->text('description')->nullable();
            $t->timestamps();
        });

        Schema::create('computer_set_product', function (Blueprint $t) {
            $t->id();
            $t->foreignId('computer_set_id')->constrained('computer_sets')->cascadeOnDelete();
            $t->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $t->unsignedInteger('qty')->default(1);
            $t->timestamps();
            $t->unique(['computer_set_id','product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_set_product');
        Schema::dropIfExists('computer_sets');
    }
};
