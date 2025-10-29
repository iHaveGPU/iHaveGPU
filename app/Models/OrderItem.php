<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'sku',
        'price',
        'qty',
        'subtotal',
    ];

    protected $casts = [
        'price'    => 'decimal:2',
        'subtotal' => 'decimal:2',
        'qty'      => 'integer',
    ];

    /* ==================== Relationships ==================== */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /* ==================== Helpers ==================== */

    public function recalcSubtotal(): void
    {
        $price = (float) $this->price;
        $qty   = (int)   $this->qty;
        $this->subtotal = $price * $qty;
    }

    /* ==================== Model Events ==================== */

    protected static function booted(): void
    {
        // ตอนสร้างรายการ: ดึงชื่อ/รหัส/ราคา จาก product หากไม่ได้กรอกมาเอง
        static::creating(function (OrderItem $item) {
            if ($item->product && $item->product_id) {
                // เติมชื่อและ SKU ถ้าเว้นว่าง
                $item->name ??= $item->product->name ?? null;
                $item->sku  ??= $item->product->sku  ?? null;

                // ถ้าไม่กำหนดราคา ใช้ราคาปัจจุบันของสินค้า
                if (is_null($item->price)) {
                    $item->price = $item->product->price;
                }
            }

            // คำนวณ subtotal
            $item->recalcSubtotal();
        });

        // ตอนอัปเดต: ถ้าเปลี่ยน qty/price ให้คำนวณ subtotal ใหม่
        static::updating(function (OrderItem $item) {
            if ($item->isDirty(['price', 'qty'])) {
                $item->recalcSubtotal();
            }
        });
    }
}
