<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','brand_id','name','slug','sku',
        'price','status','cover_image','description',
    ];

    // เพิ่ม 'cover_image_url' และคง 'cover_url' ไว้เพื่อ backward compatibility
    protected $appends = ['cover_image_url', 'cover_url', 'stock_qty', 'in_stock'];

    /* ---------- Relationships ---------- */
    public function category() { return $this->belongsTo(Category::class); }
    public function brand()    { return $this->belongsTo(Brand::class); }
    public function stock()    { return $this->hasOne(Stock::class); }
    public function attributes(){ return $this->hasMany(ProductAttribute::class); }

    /* ---------- Accessors ---------- */

    // ตัวหลัก: คืน URL รูป ไม่ว่ามาจาก seeder (public/...) หรือ upload (storage/...)
    public function getCoverImageUrlAttribute(): string
    {
        $p = $this->cover_image;

        if (!$p) {
            return asset('images/placeholder-product.png');
        }

        // ถ้าเป็น URL เต็มหรือขึ้นต้นด้วย /
        if (Str::startsWith($p, ['http://','https://','/'])) {
            return $p;
        }

        // รูปจาก seeder อยู่ภายใต้ public/images/...
        if (Str::startsWith($p, 'images/')) {
            return asset($p);                // -> /images/...
        }

        // รูปที่ staff อัปโหลดภายใต้ storage/app/public/...
        if (Storage::disk('public')->exists($p)) {
            return Storage::disk('public')->url($p);  // -> /storage/...
        }

        // กันพลาด
        return asset('images/placeholder-product.png');
    }

    // ชื่อเก่า ให้ชี้ไปยังตัวหลัก (กัน view อื่นพัง)
    public function getCoverUrlAttribute(): string
    {
        return $this->cover_image_url;
    }

    public function getStockQtyAttribute(): int
    {
        return (int) optional($this->stock)->qty;
    }

    public function getInStockAttribute(): bool
    {
        return $this->stock_qty > 0;
    }
}
