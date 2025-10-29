<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','logo'];

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    protected static function booted(): void
    {
        static::saving(function (Brand $b) {
            if (empty($b->slug)) {
                $b->slug = Str::slug($b->name);
            }
        });
    }
    // เอาไว้เรียก URL เต็ม ๆ ตอนแสดงผล
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/'.$this->logo) : null;
    }
}
