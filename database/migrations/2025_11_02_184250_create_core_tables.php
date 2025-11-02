<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // users
        Schema::create('users', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email')->unique();
            $t->timestamp('email_verified_at')->nullable();
            $t->string('password');

            // RBAC เบื้องต้น
            $t->enum('role', ['admin','staff','customer'])->default('customer');

            // โปรไฟล์ / ที่อยู่
            $t->string('phone')->nullable();
            $t->string('line_id')->nullable();
            $t->string('address1')->nullable();
            $t->string('address2')->nullable();
            $t->string('district')->nullable();
            $t->string('province')->nullable();
            $t->string('postcode', 10)->nullable();

            $t->rememberToken();
            $t->timestamps();
        });

        // password reset tokens
        Schema::create('password_reset_tokens', function (Blueprint $t) {
            $t->string('email')->primary();
            $t->string('token');
            $t->timestamp('created_at')->nullable();
        });

        // sessions
        Schema::create('sessions', function (Blueprint $t) {
            $t->string('id')->primary();
            $t->foreignId('user_id')->nullable()->index();
            $t->string('ip_address', 45)->nullable();
            $t->text('user_agent')->nullable();
            $t->longText('payload');
            $t->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
