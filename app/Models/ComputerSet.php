<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComputerSet extends Model
{
    use HasFactory;

    // ถ้าตารางชื่อ `computer_sets` ตามมาตรฐาน ไม่ต้องกำหนด $table ก็ได้
    // protected $table = 'computer_sets';

    /**
     * วิธีแก้ Mass Assignment:
     * - เลือกอย่างใดอย่างหนึ่งระหว่างตั้ง $fillable ให้ครบ หรือเปิดทั้งหมดด้วย $guarded = [];
     * แนะนำแบบ fillable เพื่อความปลอดภัยกว่า
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image',
    ];
    // ทางลัดที่ยอมหมด (ถ้าอยากง่ายสุด):
    // protected $guarded = [];

    protected $casts = [
        // ถ้าต้องการ cast เพิ่มเติมค่อยใส่ เช่น 'something' => 'integer'
    ];

    /* ---------------- Relationships ---------------- */

    public function products()
    {
        // pivot table: computer_set_product (แนะนำ)
        // ถ้าใช้ชื่ออื่นให้แก้ให้ตรง
        return $this->belongsToMany(Product::class, 'computer_set_product')
            ->withPivot(['qty'])
            ->withTimestamps();
    }

    /* ---------------- Accessors/Helpers ---------------- */

    public function getCoverUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            return null;
        }
        // ถ้าจัดเก็บใน storage:public
        return \Storage::disk('public')->url($this->cover_image);
    }
}
