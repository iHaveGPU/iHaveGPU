<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // เช็คก่อนค่อยเพิ่ม
        if (!Schema::hasColumn('products', 'cover_image')) {
            Schema::table('products', function (Blueprint $t) {
                $t->string('cover_image')->nullable()->after('price');
            });
        }
    }

    public function down(): void
    {
        // เช็คก่อนค่อยลบ
        if (Schema::hasColumn('products', 'cover_image')) {
            Schema::table('products', function (Blueprint $t) {
                $t->dropColumn('cover_image');
            });
        }
    }
};
