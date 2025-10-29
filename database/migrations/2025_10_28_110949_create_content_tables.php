<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('slug')->unique();
            $t->string('excerpt')->nullable();
            $t->longText('content')->nullable();
            $t->string('cover_image')->nullable();
            $t->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $t->timestamp('published_at')->nullable();
            $t->boolean('is_published')->default(false);
            $t->timestamps();
        });

        Schema::create('contact_channels', function (Blueprint $t) {
            $t->id();
            $t->string('group')->default('general'); // general, social, support, sales, ...
            $t->string('type')->default('text');     // text, phone, email, link, address, line
            $t->string('label');
            $t->string('value')->nullable();
            $t->string('url')->nullable();
            $t->integer('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_channels');
        Schema::dropIfExists('articles');
    }
};
