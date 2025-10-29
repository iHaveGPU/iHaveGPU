<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','sku','price','status','category_id','brand_id','cover_image'
    ];

    public function brand()     { return $this->belongsTo(Brand::class); }
    public function category()  { return $this->belongsTo(Category::class); }
    public function stock()     { return $this->hasOne(Stock::class); }
    public function attributes(){ return $this->hasMany(ProductAttribute::class)->orderBy('sort_order'); }

    public function getCoverUrlAttribute()
    {
        return $this->cover_image
            ? \Storage::disk('public')->url($this->cover_image)
            : asset('images/no-image.png');
    }
}
