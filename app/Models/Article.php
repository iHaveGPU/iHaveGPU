<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','excerpt','content','cover_image',
        'author_id','published_at','is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    // สร้าง slug อัตโนมัติถ้าไม่ได้ส่งมา
    protected static function booted()
    {
        static::creating(function ($a) {
            if (empty($a->slug)) {
                $a->slug = Str::slug(Str::limit($a->title, 60, ''));
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scope เฉพาะบทความเผยแพร่แล้ว
    public function scopePublished($q)
    {
        return $q->where('is_published', true)
                 ->whereNotNull('published_at')
                 ->where('published_at', '<=', now());
    }
}
