<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'cover_image',
        'is_published',
        'published_at',
        'author_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        // ถ้าใช้ App\Models\User
        return $this->belongsTo(User::class, 'author_id');
    }

    /** ใช้ slug เป็น route key */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** scope บทความที่เผยแพร่แล้ว */
    public function scopePublished(Builder $q): Builder
    {
        return $q->where('is_published', true)
                 ->whereNotNull('published_at')
                 ->where('published_at', '<=', now());
    }
}
