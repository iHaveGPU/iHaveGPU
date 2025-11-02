<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddCPUSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // 1) AMD Ryzen 5 5500 (AM4)
            [
                'name'     => 'AMD AM4 RYZEN 5 5500 3.6GHz 6C 12T',
                'sku'      => 'SKU-140594',
                'category' => ['slug' => 'cpu', 'name' => 'CPU'],
                'brand'    => 'AMD',
                'price'    => 2990.00,
                'image'    => 'images/Product/CPU/AMD AM4 RYZEN 5 5500 3.6GHz 6C 12T.png',
                'attributes' => [
                    ['name' => 'Brand',               'value' => 'AMD'],
                    ['name' => 'Series',              'value' => '5000 Series'],
                    ['name' => 'Processor Number',    'value' => 'Ryzen 5 5500'],
                    ['name' => 'Socket Type',         'value' => 'AM4'],
                    ['name' => 'Cores/Threads',       'value' => '6 Cores / 12 Threads'],
                    ['name' => 'Base Frequency',      'value' => '3.6 GHz'],
                    ['name' => 'Max Turbo Frequency', 'value' => '4.2 GHz'],
                    ['name' => 'L2 Cache',            'value' => '3 MB'],
                    ['name' => 'L3 Cache',            'value' => '16 MB'],
                    ['name' => 'Graphics Models',     'value' => 'Discrete Graphics Card Required'],
                    ['name' => '64Bit Support',       'value' => 'N/A'],
                    ['name' => 'CPU Cooler',          'value' => 'Yes'],
                    ['name' => 'Default TDP',         'value' => '65W'],
                    ['name' => 'Warranty',            'value' => '3 Years'],
                ],
            ],

            // 2) AMD Ryzen 5 7500F (AM5)
            [
                'name'     => 'AMD AM5 RYZEN 5 7500F 3.7GHz 6C 12T (3Y)',
                'sku'      => 'SKU-241024243',
                'category' => ['slug' => 'cpu', 'name' => 'CPU'],
                'brand'    => 'AMD',
                'price'    => 5090.00,
                'image'    => 'images/Product/CPU/AMD AM5 RYZEN 5 7500F 3.7GHz 6C 12T (3Y).png',
                'attributes' => [
                    ['name' => 'Brand',               'value' => 'AMD'],
                    ['name' => 'Series',              'value' => '7000 Series'],
                    ['name' => 'Processor Number',    'value' => 'Ryzen 5 7500F'],
                    ['name' => 'Socket Type',         'value' => 'AM5'],
                    ['name' => 'Cores/Threads',       'value' => '6 Cores / 12 Threads'],
                    ['name' => 'Base Frequency',      'value' => '3.7 GHz'],
                    ['name' => 'Max Turbo Frequency', 'value' => '5.0 GHz'],
                    ['name' => 'L2 Cache',            'value' => '6 MB'],
                    ['name' => 'L3 Cache',            'value' => '32 MB'],
                    ['name' => 'Graphics Models',     'value' => 'Discrete Graphics Card Required'],
                    ['name' => 'CPU Cooler',          'value' => 'Yes'],
                    ['name' => 'Default TDP',         'value' => '65W'],
                    ['name' => 'Maximum Turbo Power', 'value' => '95 Watt'],
                    ['name' => 'Warranty',            'value' => '3 Years'],
                ],
            ],

            // 3) Intel Core Ultra 5 225F (LGA1851)
            [
                'name'     => 'INTEL 1851 CORE ULTRA 5 225F 3.3GHz 10C 10T (3Y)',
                'sku'      => 'SKU-250127572',
                'category' => ['slug' => 'cpu', 'name' => 'CPU'],
                'brand'    => 'INTEL',
                'price'    => 5090.00,
                'image'    => 'images/Product/CPU/INTEL 1851 CORE ULTRA 5 225F 3.3GHz 10C 10T (3Y).png',
                'attributes' => [
                    ['name' => 'Brand',               'value' => 'INTEL'],
                    ['name' => 'Series',              'value' => 'CORE ULTRA 5 Processors'],
                    ['name' => 'Processor Number',    'value' => 'ULTRA 5 225F'],
                    ['name' => 'Socket Type',         'value' => 'LGA 1851'],
                    ['name' => 'Cores/Threads',       'value' => '10 (6P+4E) Cores / 10 Threads'],
                    ['name' => 'Base Frequency',      'value' => '3.3 GHz'],
                    ['name' => 'Max Turbo Frequency', 'value' => '4.9 GHz'],
                    ['name' => 'L2 Cache',            'value' => '22 MB'],
                    ['name' => 'L3 Cache',            'value' => '20 MB Intel® Smart Cache'],
                    ['name' => 'Graphics Models',     'value' => 'Intel® Ultra 5'],
                    ['name' => 'CPU Cooler',          'value' => 'N/A'],
                    ['name' => 'Default TDP',         'value' => '65W'],
                    ['name' => 'Maximum Turbo Power', 'value' => '121W'],
                    ['name' => 'Warranty',            'value' => '3 Years'],
                ],
            ],

            // 4) Intel Core Ultra 7 265K (LGA1851)
            [
                'name'     => 'INTEL 1851 CORE ULTRA 7 265K 3.3GHz 20C 20T (3Y)',
                'sku'      => 'SKU-241024254',
                'category' => ['slug' => 'cpu', 'name' => 'CPU'],
                'brand'    => 'INTEL',
                'price'    => 10490.00,
                'image'    => 'images/Product/CPU/INTEL 1851 CORE ULTRA 7 265K 3.3GHz 20C 20T (3Y).png',
                'attributes' => [
                    ['name' => 'Brand',               'value' => 'INTEL'],
                    ['name' => 'Series',              'value' => 'CORE ULTRA 7 Processors'],
                    ['name' => 'Processor Number',    'value' => 'ULTRA 7 265K'],
                    ['name' => 'Socket Type',         'value' => 'LGA 1851'],
                    ['name' => 'Cores/Threads',       'value' => '20 Core / 20 Threads'],
                    ['name' => 'Base Frequency',      'value' => '3.9 GHz'],
                    ['name' => 'Max Turbo Frequency', 'value' => '5.5 GHz'],
                    ['name' => 'L2 Cache',            'value' => '36 MB'],
                    ['name' => 'L3 Cache',            'value' => '30 MB Intel Smart Cache'],
                    ['name' => 'CPU Cooler',          'value' => 'No'],
                    ['name' => 'Default TDP',         'value' => '125W'],
                    ['name' => 'Maximum Turbo Power', 'value' => '250W'],
                    ['name' => 'Warranty',            'value' => '3 Years'],
                ],
            ],

            // 5) AMD Ryzen 9 9950X3D (AM5)
            [
                'name'     => 'AMD AM5 RYZEN 9 9950X3D 4.3GHz 16C 32T (3Y)',
                'sku'      => 'SKU-250330027',
                'category' => ['slug' => 'cpu', 'name' => 'CPU'],
                'brand'    => 'AMD',
                'price'    => 26990.00,
                'image'    => 'images/Product/CPU/AMD AM5 RYZEN 9 9950X3D 4.3GHz 16C 32T (3Y).png',
                'attributes' => [
                    ['name' => 'Brand',               'value' => 'AMD'],
                    ['name' => 'Series',              'value' => '9000 Series'],
                    ['name' => 'Processor Number',    'value' => 'Ryzen 9 9950X3D'],
                    ['name' => 'Socket Type',         'value' => 'AM5'],
                    ['name' => 'Cores/Threads',       'value' => '16 Core / 32 Threads'],
                    ['name' => 'Base Frequency',      'value' => '4.3 GHz'],
                    ['name' => 'Max Turbo Frequency', 'value' => '5.7 GHz'],
                    ['name' => 'L2 Cache',            'value' => '16 MB'],
                    ['name' => 'L3 Cache',            'value' => '64 MB'],
                    ['name' => 'Graphics Models',     'value' => 'AMD Radeon Graphics'],
                    ['name' => 'CPU Cooler',          'value' => 'No'],
                    ['name' => 'Default TDP',         'value' => '170W'],
                    ['name' => 'Warranty',            'value' => '3 Years'],
                ],
            ],
               ];

     // ====== รูปภาพ (CPU) ใช้ชื่อไฟล์ = SKU ======
$imageBaseDir = public_path('images/Product/CPU');
$imageRelDir  = 'images/Product/CPU';

// ใส่รูปลงทุกคอลัมน์รูปที่มีจริง (รวม cover_image)
$imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

// หาไฟล์รูปด้วย SKU เป็นหลัก แล้วค่อย fallback
$resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir): ?string {
    $exts = ['png','jpg','jpeg','webp','jfif'];
    $sku  = $item['sku'] ?? '';

    // 1) ไฟล์ชื่อเท่ากับ SKU แบบตรงตัว
    if ($sku && is_dir($imageBaseDir)) {
        foreach ($exts as $e) {
            $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $sku . '.' . $e;
            if (file_exists($abs)) {
                return $imageRelDir . '/' . $sku . '.' . $e;
            }
        }
        // 1.1) เผื่อมี prefix/suffix รอบ SKU
        foreach (scandir($imageBaseDir) ?: [] as $f) {
            if ($f === '.' || $f === '..') continue;
            $p   = $imageBaseDir . DIRECTORY_SEPARATOR . $f;
            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
            if (is_file($p) && in_array($ext, $exts, true) && stripos($f, $sku) !== false) {
                return $imageRelDir . '/' . $f;
            }
        }
    }

    // 2) ใช้ path ที่กำหนดมาใน item['image'] ถ้ามี
    if (!empty($item['image'])) {
        $abs = public_path($item['image']);
        return file_exists($abs) ? $item['image'] : null;
    }

    // 3) เดาจากชื่อสินค้า
    $raw  = trim($item['name'] ?? '');
    $raw  = str_replace(['/', '\\'], '_', $raw);
    $base = preg_replace('/\s+/', ' ', $raw);
    foreach ($exts as $e) {
        $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $base . '.' . $e;
        if (file_exists($abs)) {
            return $imageRelDir . '/' . $base . '.' . $e;
        }
    }
    return null;
};

foreach ($items as $item) {
    // Category & Brand
    $category = Category::updateOrCreate(
        ['slug' => $item['category']['slug']],
        ['name' => $item['category']['name'], 'sort_order' => 0]
    );
    $brand = Brand::updateOrCreate(
        ['slug' => Str::slug($item['brand'])],
        ['name' => $item['brand']]
    );

    // Payload หลัก
    $payload = [
        'name'        => $item['name'],
        'category_id' => $category->id,
        'brand_id'    => $brand->id,
        'price'       => $item['price'],
    ];
    if (Schema::hasColumn('products','status')) {
        $payload['status'] = 'active';
    }

    // รูป: ใส่ลงทุกคอลัมน์รูปที่ "มีจริง" รวม cover_image
    $imgRel = $resolveImage($item); // <-- ใช้ชื่อฟังก์ชันให้ตรง!
    if ($imgRel) {
        foreach ($imgCols as $col) {
            if (Schema::hasColumn('products', $col)) {
                $payload[$col] = $imgRel;
            }
        }
    }

    /** @var \App\Models\Product $product */
    $product = Product::updateOrCreate(['sku' => $item['sku']], $payload);

    // แจ้งเตือนถ้าไฟล์รูปหายไป
    if (isset($this->command) && $imgRel) {
        $full = public_path($imgRel);
        if (!file_exists($full)) {
            $this->command->warn("Image not found for SKU {$item['sku']}: {$full}");
        }
    }

    // สต็อกตั้งต้น
    if (Schema::hasTable('stocks')) {
        \App\Models\Stock::updateOrCreate(
            ['product_id' => $product->id],
            ['qty' => 100]
        );
    }

    // attributes
    if (method_exists($product, 'attributes')) {
        $product->attributes()->delete();
        $attrs = array_map(function ($a, $i) {
            $a['sort_order'] = $a['sort_order'] ?? ($i + 1);
            return $a;
        }, $item['attributes'], array_keys($item['attributes']));
        $product->attributes()->createMany($attrs);
    }

    // images relation (ถ้ามี)
    if (method_exists($product, 'images') && $imgRel) {
        $product->images()->delete();
        $product->images()->createMany([
            ['path' => $imgRel, 'sort_order' => 1],
        ]);
    }
}
    }
}