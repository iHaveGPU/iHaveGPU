<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // เลือกโต๊ะที่มีอยู่จริง
        $table = null;
        if (Schema::hasTable('computer_sets')) {
            $table = 'computer_sets';
        } elseif (Schema::hasTable('sets')) {
            $table = 'sets';
        }

        // ถ้าไม่พบโต๊ะ ให้หยุด (กันพัง)
        if (! $table) {
            throw new RuntimeException('Neither "computer_sets" nor "sets" table exists.');
        }

        if (! Schema::hasColumn($table, 'cover_image')) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('cover_image')->nullable()->after('slug');
            });
        }
    }

    public function down(): void
    {
        $table = null;
        if (Schema::hasTable('computer_sets')) {
            $table = 'computer_sets';
        } elseif (Schema::hasTable('sets')) {
            $table = 'sets';
        }

        if ($table && Schema::hasColumn($table, 'cover_image')) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('cover_image');
            });
        }
    }
};
