<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('brands', function (Blueprint $t) {
            if (!Schema::hasColumn('brands','logo')) {
                $t->string('logo')->nullable()->after('slug'); // เก็บพาธรูป (storage/app/public/brands/...)
            }
        });
    }
    public function down(): void {
        Schema::table('brands', function (Blueprint $t) {
            if (Schema::hasColumn('brands','logo')) {
                $t->dropColumn('logo');
            }
        });
    }
};
