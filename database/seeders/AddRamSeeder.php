<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddRamSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name'     => 'GEIL ORION PHANTOM GAMING 16GB (8x2) DDR4 3200MHz GRAY (GAOG416GB3200C16BDC) (LT)',
                'sku'      => 'SKU-241226925',
                'category' => ['slug' => 'ram', 'name' => 'RAM'],
                'brand'    => 'GEIL',
                'price'    => 2190.00,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'GEIL'],
                    ['name' => 'Memory Series', 'value' => 'ORION'],
                    ['name' => 'Memory Capacity', 'value' => '16GB (2x 8GB)'],
                    ['name' => 'Speed', 'value' => '3200MHz'],
                    ['name' => 'Memory Type', 'value' => 'DDR4'],
                    ['name' => 'Cas Latency', 'value' => 'CL16'],
                    ['name' => 'SPD Voltage', 'value' => '1.20-1.35 V'],
                    ['name' => 'Memory Color', 'value' => 'GRAY'],
                    ['name' => 'Warranty', 'value' => 'Lifetime'],
                ],
            ],
            [
                'name'     => 'HIKSEMI ARMOR 16GB (8x2) DDR4 3200Mhz BLACK (HSC416U32D3) (LT)',
                'sku'      => 'SKU-250736246',
                'category' => ['slug' => 'ram', 'name' => 'RAM'],
                'brand'    => 'HIKSEMI',
                'price'    => 2190.00,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'HIKSEMI'],
                    ['name' => 'Memory Series', 'value' => 'ARMOR'],
                    ['name' => 'Memory Capacity', 'value' => '16GB (2x 8GB)'],
                    ['name' => 'Speed', 'value' => '3200MHz'],
                    ['name' => 'Memory Type', 'value' => 'DDR4'],
                    ['name' => 'Cas Latency', 'value' => 'CL18'],
                    ['name' => 'Tested Latency', 'value' => '18-22-22-42'],
                    ['name' => 'SPD Voltage', 'value' => '1.25 V'],
                    ['name' => 'Memory Color', 'value' => 'BLACK'],
                    ['name' => 'Warranty', 'value' => 'Lifetime'],
                ],
            ],
            [
                'name'     => 'APACER NOX 16GB (16x1) DDR4 3200MHz WHITE (AH4U16G32C28YMWAA-1) (LT)',
                'sku'      => 'SKU-251039808',
                'category' => ['slug' => 'ram', 'name' => 'RAM'],
                'brand'    => 'APACER',
                'price'    => 2190.00,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'APACER'],
                    ['name' => 'Memory Series', 'value' => 'NOX'],
                    ['name' => 'Memory Capacity', 'value' => '16GB'],
                    ['name' => 'Speed', 'value' => '3200MHz'],
                    ['name' => 'Memory Type', 'value' => 'DDR4'],
                    ['name' => 'Cas Latency', 'value' => 'CL16'],
                    ['name' => 'Tested Latency', 'value' => '16-20-20-38'],
                    ['name' => 'SPD Voltage', 'value' => '1.35 V'],
                    ['name' => 'Memory Color', 'value' => 'WHITE'],
                    ['name' => 'Warranty', 'value' => 'Lifetime'],
                ],
            ],
            [
                'name'     => 'KINGSTON FURY BEAST 16GB (8x2) DDR4 3200MHz BLACK (KF432C16BBK2/16)',
                'sku'      => 'SKU-141952',
                'category' => ['slug' => 'ram', 'name' => 'RAM'],
                'brand'    => 'KINGSTON',
                'price'    => 2290.00,
                'attributes' => [
                    ['name' => 'Memory Series', 'value' => 'KF432C16BBK2/16'],
                    ['name' => 'Memory Capacity', 'value' => '16GB (8GBx2)'],
                    ['name' => 'Cas Latency', 'value' => 'CL16'],
                    ['name' => 'Memory Type', 'value' => 'DDR4'],
                    ['name' => 'Tested Latency', 'value' => '16-18-18'],
                    ['name' => 'SPD Voltage', 'value' => '1.2 V'],
                    ['name' => 'Memory Color', 'value' => 'BLACK'],
                    ['name' => 'Warranty', 'value' => 'Lifetime'],
                ],
            ],
            [
                'name'     => 'PREDATOR VESTA II RGB 32GB (16x2) DDR5 6000MHz BLACK (BL.9BWWR.652) (LT)',
                'sku'      => 'SKU-250938371',
                'category' => ['slug' => 'ram', 'name' => 'RAM'],
                'brand'    => 'PREDATOR',
                'price'    => 6490.00,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'PREDATOR'],
                    ['name' => 'Memory Series', 'value' => 'VESTA II RGB'],
                    ['name' => 'Memory Capacity', 'value' => '32GB (2x 16GB)'],
                    ['name' => 'Speed', 'value' => '6000MHz'],
                    ['name' => 'Memory Type', 'value' => 'DDR5'],
                    ['name' => 'Cas Latency', 'value' => 'CL36'],
                    ['name' => 'Tested Latency', 'value' => '36-45-45-96'],
                    ['name' => 'SPD Voltage', 'value' => '1.30 V'],
                    ['name' => 'Memory Color', 'value' => 'BLACK'],
                    ['name' => 'Warranty', 'value' => 'Lifetime'],
                ],
            ],
        ];

        // ===== Auto image resolver for RAM =====
        $imageBaseDir = public_path('images/Product/RAM');
        $imageRelDir  = 'images/Product/RAM';

        // เติมทุกคอลัมน์รูปที่มีจริง (รวม cover_image)
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

        // ตัวช่วยตั้งชื่อไฟล์จากชื่อสินค้า
        $makeBasename = function (string $name): string {
            $n = trim($name);
            $n = str_replace(['/', '\\'], '_', $n);
            return preg_replace('/\s+/', ' ', $n);
        };

        // หาไฟล์รูป: 1) ชื่อไฟล์มี SKU 2) ใช้ field image ถ้ามี 3) เดาจากชื่อ
        $resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir, $makeBasename): ?string {
            $exts = ['png', 'jpg', 'jpeg', 'webp'];
            $sku  = $item['sku'] ?? '';

            // 1) ไฟล์ที่มี SKU ในชื่อ
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
            $base = $makeBasename($item['name'] ?? '');
            foreach ($exts as $e) {
                $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $base . '.' . $e;
                if (file_exists($abs)) {
                    return $imageRelDir . '/' . $base . '.' . $e;
                }
            }

            // 3.1 ค้นหาแบบไม่สนตัวพิมพ์เล็กใหญ่ (fallback)
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

            // ใส่รูปลงทุกคอลัมน์ที่มีจริง
            $imgRel = $resolveImage($item);
            if ($imgRel) {
                foreach ($imgCols as $col) {
                    if (Schema::hasColumn('products', $col)) {
                        $payload[$col] = $imgRel;
                    }
                }
            }

            /** @var \App\Models\Product $product */
            $product = Product::updateOrCreate(['sku' => $item['sku']], $payload);

            // แจ้งเตือนช่วย debug
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

            // สต็อกเริ่มต้น (RAM = 0)
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
