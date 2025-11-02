<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ComputerSet;

class AddComputerSetSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * โครงสร้าง:
         * name        : ชื่อชุด
         * slug        : (เว้นว่างให้ gen อัตโนมัติได้)
         * description : คำอธิบายสั้น ๆ
         * items       : รายการสินค้าในชุด (อิงจาก SKU) + qty
         */
        $sets = [
            [
                'name'        => 'Entry Gaming – AMD',
                'description' => 'ชุดเล่นเกมเริ่มต้น CPU AMD + RTX 3050 + SSD 1TB + RAM 16GB + PSU 600W',
                'items' => [
                    // CPU (จากที่คุณเคย seed)
                    ['sku' => 'SKU-241024243', 'qty' => 1], // AMD RYZEN 5 7500F
                    // GPU
                    ['sku' => 'SKU-250127777', 'qty' => 1], // MSI RTX 3050 Ventus 6G
                    // RAM
                    ['sku' => 'SKU-241226925', 'qty' => 1], // GEIL ORION 16GB (8x2) DDR4-3200
                    // SSD
                    ['sku' => 'SKU-251039599', 'qty' => 1], // ADATA SU650 1TB
                    // PSU
                    ['sku' => 'SKU-139685',     'qty' => 1], // AEROCOOL UNITED POWER 600W
                ],
            ],
            [
                'name'        => 'Entry Gaming – Intel',
                'description' => 'ชุดเล่นเกมเริ่มต้น CPU Intel + RTX 3050 + SSD 1TB + RAM 16GB + PSU 750W',
                'items' => [
                    // CPU (จากที่คุณเคย seed)
                    ['sku' => 'SKU-250127572', 'qty' => 1], // Intel Core Ultra 5 225F
                    // GPU
                    ['sku' => 'SKU-250127778', 'qty' => 1], // Gigabyte RTX 3050 WF OC V2 6G
                    // RAM
                    ['sku' => 'SKU-141952',    'qty' => 1], // Kingston Fury Beast 16GB (8x2) DDR4-3200
                    // SSD
                    ['sku' => 'SKU-251040416', 'qty' => 1], // Colorful SL500 512GB
                    // PSU
                    ['sku' => 'SKU-250431597', 'qty' => 1], // Gigabyte GP-P750BS 750W
                ],
            ],
            [
                'name'        => 'Creator Build – RX 7600 + DDR5',
                'description' => 'สายตัดต่อ/สร้างคอนเทนต์ RX 7600 + DDR5 32GB + SSD พกพา + PSU 850W',
                'items' => [
                    // CPU – เลือกตามที่คุณมี seed ไว้ จะใช้ AMD R5 ก็ได้
                    ['sku' => 'SKU-241024243', 'qty' => 1], // AMD RYZEN 5 7500F
                    // GPU
                    ['sku' => 'SKU-09983',     'qty' => 1], // XFX RX 7600 8GB
                    // RAM DDR5
                    ['sku' => 'SKU-250938371', 'qty' => 1], // Predator VESTA II RGB 32GB DDR5-6000
                    // SSD พกพา
                    ['sku' => 'SKU-251039823', 'qty' => 1], // Transcend ESD310 1TB (USB-C/A)
                    // PSU 850W
                    ['sku' => 'SKU-240314132', 'qty' => 1], // Gigabyte UD850GM PG5 V2 850W
                ],
            ],
        ];

        foreach ($sets as $def) {
            $name  = $def['name'];
            $slug  = Str::slug($def['slug'] ?? $name);
            $desc  = $def['description'] ?? null;
            $items = $def['items'] ?? [];

            // หา/สร้างชุด
            /** @var \App\Models\ComputerSet $set */
            $set = ComputerSet::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'description' => $desc]
            );

            // เตรียมผูกสินค้า
            $attach = [];
            $sum = 0;

            foreach ($items as $i => $row) {
                $sku = $row['sku'] ?? null;
                $qty = max(1, (int)($row['qty'] ?? 1));

                if (!$sku) {
                    $this->command?->warn("[$name] item #$i ไม่ระบุ SKU — ข้าม");
                    continue;
                }

                /** @var \App\Models\Product|null $p */
                $p = Product::where('sku', $sku)->first();

                if (!$p) {
                    $this->command?->warn("[$name] ไม่พบสินค้า SKU {$sku} — ข้าม");
                    continue;
                }

                $attach[$p->id] = ['qty' => $qty];
                $sum += (float)$p->price * $qty;

                // ตั้ง cover_image ของ set อัตโนมัติจากสินค้าชิ้นแรกที่มีรูป
                if (empty($set->cover_image) && !empty($p->cover_image)) {
                    $set->cover_image = $p->cover_image;
                    $set->save();
                }
            }

            // sync รายการ (แทนที่ของเดิมทั้งหมด)
            $set->products()->sync($attach);

            // log ช่วยดีบัก
            $count = count($attach);
            $this->command?->info("Seeded set: {$name} ({$count} items) ~ ฿" . number_format($sum, 2));
        }
    }
}
