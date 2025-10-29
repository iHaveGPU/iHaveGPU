<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // สถานะมาตรฐาน
    public const STATUS_DRAFT     = 'draft';
    public const STATUS_PENDING   = 'pending';   // สั่งแล้วรอแอดมิน/สตาฟตรวจ
    public const STATUS_PAID      = 'paid';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'number',          // เช่น ORD-202510-0001
        'status',
        'payment_method',  // อนุญาตให้เป็น null ได้ ถ้าไม่จ่ายตอนนี้

        // ที่อยู่จัดส่ง
        'ship_name',
        'ship_phone',
        'ship_address1',
        'ship_address2',
        'ship_district',
        'ship_province',
        'ship_postcode',

        // ยอดเงิน
        'subtotal',        // ราคารวมสินค้าทั้งหมด
        'total',           // ✅ ยอดสุทธิ (ตรงกับ subtotal เพราะไม่มีค่าส่ง/ส่วนลด)
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total'    => 'decimal:2',
    ];

    /* ==================== Relationships ==================== */

    // ถ้าคุณใช้ชื่อโมเดลแถวออเดอร์เป็น OrderItem ให้คงอันนี้
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* ==================== Helpers ==================== */

    // ที่อยู่แบบบรรทัดเดียว
    public function getShippingAddressAttribute(): string
    {
        return collect([
            $this->ship_address1,
            $this->ship_address2,
            $this->ship_district,
            $this->ship_province,
            $this->ship_postcode,
        ])->filter()->implode(', ');
    }

    /**
     * คำนวณยอดรวมจาก items แล้วอัปเดต subtotal/total
     * (ไม่มีค่าส่ง/ส่วนลด → total = subtotal)
     */
    public function recalcTotals(): void
    {
        $subtotal = $this->items->sum(fn ($i) => ($i->price * $i->qty));

        $this->subtotal = $subtotal;
        $this->total    = $subtotal; // ✅ ไม่มีส่วนลด/ค่าส่ง
        $this->save();
    }

    /**
     * สร้างเลขออเดอร์/ค่าเริ่มต้น ตอนกำลัง create
     */
    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            // เลขออเดอร์อัตโนมัติ
            if (empty($order->number)) {
                $prefix = 'ORD-' . now()->format('Ym');
                $last   = static::where('number', 'like', $prefix . '-%')->max('number');

                $seq = 1;
                if ($last && preg_match('/-(\d+)$/', $last, $m)) {
                    $seq = (int) $m[1] + 1;
                }
                $order->number = sprintf('%s-%04d', $prefix, $seq);
            }

            // ค่าเริ่มต้นสถานะและยอด
            $order->status   ??= self::STATUS_PENDING;
            $order->subtotal ??= 0;
            $order->total    ??= 0; // ✅ เท่ากับ subtotal เสมอในระบบนี้
        });
    }
}
