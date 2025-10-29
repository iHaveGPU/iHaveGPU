<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products','brand_id')) {
                $table->foreignId('brand_id')->nullable()->after('category_id');
                $table->foreign('brand_id', 'products_brand_id_foreign')
                      ->references('id')->on('brands')
                      ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products','brand_id')) {
                $table->dropForeign('products_brand_id_foreign');
                $table->dropColumn('brand_id');
            }
        });
    }
};
