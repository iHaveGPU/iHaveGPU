<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactChannel;

class AddContactSeeder extends Seeder
{
    public function run(): void
    {
        // ปรับค่าให้เหมาะกับโปรเจ็กต์/โดเมนของคุณได้ตามต้องการ
        $items = [
            // ===== General =====
            [
                'group' => 'general',
                'type'  => 'text',
                'label' => 'ที่อยู่',
                'value' => '123/45 ชั้น 3 อาคาร iHaveGPU, ถ.นิมมานเหมินท์, อ.เมือง, จ.เชียงใหม่ 50200',
                'url'   => null,
                'sort_order' => 0,
                'is_active'  => true,
            ],
            [
                'group' => 'general',
                'type'  => 'phone',
                'label' => 'โทรศัพท์',
                'value' => '+66 2 123 4567',
                'url'   => 'tel:+6621234567',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'group' => 'general',
                'type'  => 'email',
                'label' => 'อีเมลฝ่ายบริการลูกค้า',
                'value' => 'support@ihavegpu.test',
                'url'   => 'mailto:support@ihavegpu.test',
                'sort_order' => 2,
                'is_active'  => true,
            ],

            // ===== Social =====
            [
                'group' => 'social',
                'type'  => 'link',
                'label' => 'Facebook',
                'value' => 'facebook.com/ihavegpu',
                'url'   => 'https://facebook.com/ihavegpu',
                'sort_order' => 0,
                'is_active'  => true,
            ],
            [
                'group' => 'social',
                'type'  => 'link',
                'label' => 'Instagram',
                'value' => '@ihavegpu',
                'url'   => 'https://instagram.com/ihavegpu',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'group' => 'social',
                'type'  => 'link',
                'label' => 'YouTube',
                'value' => 'youtube.com/@ihavegpu',
                'url'   => 'https://www.youtube.com/@ihavegpu',
                'sort_order' => 2,
                'is_active'  => false, // ซ่อนไว้ก่อน
            ],
            [
                'group' => 'social',
                'type'  => 'line',
                'label' => 'LINE Official',
                'value' => '@ihavegpu',
                'url'   => 'https://line.me/R/ti/p/@ihavegpu',
                'sort_order' => 3,
                'is_active'  => true,
            ],

            // ===== Sales =====
            [
                'group' => 'sales',
                'type'  => 'email',
                'label' => 'ฝ่ายขาย (B2C)',
                'value' => 'sales@ihavegpu.test',
                'url'   => 'mailto:sales@ihavegpu.test',
                'sort_order' => 0,
                'is_active'  => true,
            ],
            [
                'group' => 'sales',
                'type'  => 'phone',
                'label' => 'เบอร์ฝ่ายขาย',
                'value' => '+66 81 234 5678',
                'url'   => 'tel:+66812345678',
                'sort_order' => 1,
                'is_active'  => true,
            ],

            // ===== Marketing =====
            [
                'group' => 'marketing',
                'type'  => 'email',
                'label' => 'การตลาด/สปอนเซอร์',
                'value' => 'mkt@ihavegpu.test',
                'url'   => 'mailto:mkt@ihavegpu.test',
                'sort_order' => 0,
                'is_active'  => true,
            ],
        ];

        foreach ($items as $i => $row) {
            // เผื่อไม่ได้กำหนด sort_order จะเรียงตามลำดับในอาร์เรย์
            if (!isset($row['sort_order'])) {
                $row['sort_order'] = $i;
            }
            $row['is_active'] = (bool)($row['is_active'] ?? true);

            // ใช้ key (group + label) กันซ้ำเวลา seed หลายรอบ
            ContactChannel::updateOrCreate(
                [
                    'group' => $row['group'],
                    'label' => $row['label'],
                ],
                $row
            );
        }
    }
}
