<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddSSDSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // 1) TRANSCEND ESD310 1TB Portable (USB-C/A)
            [
                'name'     => 'PORTABLE SSD TRANSCEND ESD310 1TB USB TYPE-C/A (SILVER) (TS1TESD310S) (5Y)',
                'sku'      => 'SKU-251039823',
                'category' => ['slug' => 'ssd', 'name' => 'SSD'],
                'brand'    => 'TRANSCEND',
                'price'    => 2990.00,
                'attributes' => [
                    ['name' => 'Brand',        'value' => 'TRANSCEND'],
                    ['name' => 'Form Factor',  'value' => 'N/A'],
                    ['name' => 'Capacity',     'value' => '1TB'],
                    ['name' => 'Interface',    'value' => "USB-A 3.2\nUSB-C 3.2"],
                    ['name' => 'Read Speed',   'value' => '1,050 MB/s'],
                    ['name' => 'Write Speed',  'value' => '950 MB/s'],
                    ['name' => 'Warranty',     'value' => '5 Years'],
                ],
            ],

            // 2) APACER AS350X 1TB (2.5" SATA)
            [
                'name'     => 'SSD APACER AS350X 1TB (AP1TBAS350XR-1)',
                'sku'      => 'SKU-10753',
                'category' => ['slug' => 'ssd', 'name' => 'SSD'],
                'brand'    => 'APACER',
                'price'    => 1990.00,
                'attributes' => [
                    ['name' => 'Brand',        'value' => 'APACER'],
                    ['name' => 'Form Factor',  'value' => '2.5-Inch'],
                    ['name' => 'Capacity',     'value' => '1TB'],
                    ['name' => 'Interface',    'value' => 'SATA'],
                    ['name' => 'Read Speed',   'value' => '560 MB/s'],
                    ['name' => 'Write Speed',  'value' => '540 MB/s'],
                    ['name' => 'Warranty',     'value' => '3 Years'],
                ],
            ],

            // 3) ADATA SU650 1TB (2.5" SATA)
            [
                'name'     => 'SSD ADATA SU650 1TB (ASU650SS-1TT-R) (3Y)',
                'sku'      => 'SKU-251039599',
                'category' => ['slug' => 'ssd', 'name' => 'SSD'],
                'brand'    => 'ADATA',
                'price'    => 1990,
                'attributes' => [
                    ['name' => 'Brand',        'value' => 'ADATA'],
                    ['name' => 'Form Factor',  'value' => '2.5-Inch'],
                    ['name' => 'Capacity',     'value' => '1TB'],
                    ['name' => 'Interface',    'value' => 'SATA Rev. 3.0 (6Gb/s)'],
                    ['name' => 'Read Speed',   'value' => '520 MB/s'],
                    ['name' => 'Write Speed',  'value' => '450 MB/s'],
                    ['name' => 'Warranty',     'value' => '3 Years'],
                ],
            ],

            // 4) COLORFUL SL500 512GB (2.5" SATA)
            [
                'name'     => 'SSD COLORFUL SL500 512GB (3Y)',
                'sku'      => 'SKU-251040416',
                'category' => ['slug' => 'ssd', 'name' => 'SSD'],
                'brand'    => 'COLORFUL',
                'price'    => 990,
                'attributes' => [
                    ['name' => 'Brand',        'value' => 'COLORFUL'],
                    ['name' => 'Form Factor',  'value' => '2.5-Inch'],
                    ['name' => 'Capacity',     'value' => '512GB'],
                    ['name' => 'Interface',    'value' => 'SATA Rev. 3.0 (6Gb/s)'],
                    ['name' => 'Read Speed',   'value' => '500 MB/s'],
                    ['name' => 'Write Speed',  'value' => '450 MB/s'],
                    ['name' => 'Warranty',     'value' => '3 Years'],
                ],
            ],
        ];

        // ===== Auto image resolver for SSD =====
        $imageBaseDir = public_path('images/Product/SSD');
        $imageRelDir  = 'images/Product/SSD';

        // เติมทุกคอลัมน์รูปที่มีจริง (รวม cover_image)
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

        // สร้าง basename จากชื่อสินค้า (กัน slash, ช่องว่างซ้อน)
        $makeBasename = function (string $name): string {
            $n = trim($name);
            $n = str_replace(['/', '\\'], '_', $n);  // TYPE-C/A -> TYPE-C_A
            return preg_replace('/\s+/', ' ', $n);
        };

        // หาไฟล์รูป: 1) มี SKU อยู่ในชื่อไฟล์ 2) ใช้ field image ถ้ามี 3) เดาจากชื่อ 3.1) ค้นหาแบบไม่สน case
        $resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir, $makeBasename): ?string {
            $exts = ['png', 'jpg', 'jpeg', 'webp'];
            $sku  = $item['sku'] ?? '';

            // 1) scan หาไฟล์ที่มี SKU ในชื่อ
            if ($sku && is_dir($imageBaseDir)) {
                foreach (scandir($imageBaseDir) ?: [] as $f) {
                    if ($f === '.' || $f === '..') continue;
                    $p   = $imageBaseDir . DIRECTORY_SEPARATOR . $f;
                    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                    if (is_file($p) && in_array($ext, $exts, true) && stripos($f, $sku) !== false) {
                        return $imageRelDir . '/' . $f;
                    }
                }
            }

            // 2) ใช้ฟิลด์ image ถ้ามีและไฟล์อยู่จริง
            if (!empty($item['image'])) {
                $abs = public_path($item['image']);
                if (file_exists($abs)) {
                    return $item['image'];
                }
            }

            // 3) เดาจากชื่อสินค้า
            $base = $makeBasename($item['name']);
            foreach ($exts as $e) {
                $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $base . '.' . $e;
                if (file_exists($abs)) {
                    return $imageRelDir . '/' . $base . '.' . $e;
                }
            }

            // 3.1) ค้นหาแบบ case-insensitive
            if (is_dir($imageBaseDir)) {
                $want = strtolower($base);
                foreach (scandir($imageBaseDir) ?: [] as $fname) {
                    if ($fname === '.' || $fname === '..') continue;
                    $path = $imageBaseDir . DIRECTORY_SEPARATOR . $fname;
                    if (!is_file($path)) continue;
                    $nameNoExt = pathinfo($fname, PATHINFO_FILENAME);
                    if (strtolower($nameNoExt) === $want) {
                        return $imageRelDir . '/' . $fname;
                    }
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

            // Product payload
            $payload = [
                'name'        => $item['name'],
                'category_id' => $category->id,
                'brand_id'    => $brand->id,
                'price'       => $item['price'],
            ];
            if (Schema::hasColumn('products', 'status')) {
                $payload['status'] = 'active';
            }

            // เติมรูปลงทุกคอลัมน์ที่มีจริง
            $imgRel = $resolveImage($item);
            if ($imgRel) {
                foreach ($imgCols as $col) {
                    if (Schema::hasColumn('products', $col)) {
                        $payload[$col] = $imgRel;
                    }
                }
            }

            /** @var \App\Models\Product $product */
            $product = Product::updateOrCreate(
                ['sku' => $item['sku']],
                $payload
            );

            // เตือนช่วย debug ถ้าไม่พบไฟล์
            if (isset($this->command)) {
                if ($imgRel) {
                    $full = public_path($imgRel);
                    if (!file_exists($full)) {
                        $this->command->warn("Image not found for SKU {$item['sku']}: {$full}");
                    }
                } else {
                    $this->command->warn("No image matched for SKU {$item['sku']} in {$imageBaseDir}");
                }
            }

            // stock เริ่มต้น (SSD = 0)
            if (Schema::hasTable('stocks')) {
                \App\Models\Stock::updateOrCreate(
                    ['product_id' => $product->id],
                    ['qty' => 0]
                );
            }

            // attributes relation
            if (method_exists($product, 'attributes')) {
                $product->attributes()->delete();
                $attrs = array_map(function ($a, $i) {
                    $a['sort_order'] = $a['sort_order'] ?? ($i + 1);
                    return $a;
                }, $item['attributes'], array_keys($item['attributes']));
                $product->attributes()->createMany($attrs);
            }

            // images relation (ถ้ามีในโมเดล)
            if (method_exists($product, 'images') && $imgRel) {
                $product->images()->delete();
                $product->images()->createMany([
                    ['path' => $imgRel, 'sort_order' => 1],
                ]);
            }
        }
    }
}
