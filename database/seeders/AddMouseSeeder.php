<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddMouseSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name'     => 'MOUSE CORSAIR M75 WIRELESS CALL OF DUTY BLACK OPS 6 (CH-931D11D-NA) (2Y)',
                'sku'      => 'SKU-250127772',
                'category' => ['slug' => 'mouse', 'name' => 'MOUSE'],
                'brand'    => 'CORSAIR',
                'price'    => 5990,
                'attributes' => [
                    ['name' => 'Brand','value' => 'CORSAIR'],
                    ['name' => 'Tilt scroll function','value' => 'N/A'],
                    ['name' => 'Click life span','value' => '100 MILLION'],
                    ['name' => 'Scroll Wheel','value' => 'Yes'],
                    ['name' => 'Number of buttons','value' => '5 buttons'],
                    ['name' => 'Battery Life','value' => '105 hours (BT up to 210hrs)'],
                    ['name' => 'Battery Type','value' => 'N/A'],
                    ['name' => 'Interface','value' => '2.4GHz Wireless'],
                    ['name' => 'Sensor Resolution','value' => '26,000 DPI'],
                    ['name' => 'Sensor technology','value' => 'MARKSMAN 26K'],
                    ['name' => 'Wireless technology','value' => '2.4GHz Wireless Technology'],
                    ['name' => 'Color','value' => 'BLACK'],
                    ['name' => 'Warranty','value' => '2 Years'],
                ],
            ],
            [
                'name'     => 'MOUSE RAZER BASILISK V3 PRO BLACK (2Y)',
                'sku'      => 'SKU-250229183',
                'category' => ['slug' => 'mouse', 'name' => 'MOUSE'],
                'brand'    => 'RAZER',
                'price'    => 4890,
                'attributes' => [
                    ['name' => 'Brand','value' => 'RAZER'],
                    ['name' => 'Tilt scroll function','value' => 'N/A'],
                    ['name' => 'Click life span','value' => '90 MILLION'],
                    ['name' => 'Scroll Wheel','value' => 'Yes'],
                    ['name' => 'Number of buttons','value' => '11 buttons'],
                    ['name' => 'Battery Life','value' => 'Up to 90 hours (HyperSpeed)'],
                    ['name' => 'Battery Type','value' => 'Lithium-Ion 600mAh'],
                    ['name' => 'Interface','value' => "Bluetooth\nRazer HyperSpeed Wireless 2.4GHz\nWired – USB Type-C Speedflex"],
                    ['name' => 'Sensor Resolution','value' => '30,000 DPI'],
                    ['name' => 'Sensor technology','value' => 'Focus Pro 30K Optical'],
                    ['name' => 'Wireless technology','value' => 'Wireless 2.4G'],
                    ['name' => 'Dimensions','value' => '130 x 75.4 x 42.5 mm'],
                    ['name' => 'Color','value' => 'BLACK'],
                    ['name' => 'Warranty','value' => '2 Years'],
                ],
            ],
            [
                'name'     => 'MOUSE RAZER VIPER V2 PRO WHITE (2Y)',
                'sku'      => 'SKU-13459',
                'category' => ['slug' => 'mouse', 'name' => 'MOUSE'],
                'brand'    => 'RAZER',
                'price'    => 3990,
                'attributes' => [
                    ['name' => 'Brand','value' => 'RAZER'],
                    ['name' => 'Dimensions','value' => '126.5 x 66.2 x 37.8 mm'],
                    ['name' => 'Click life span','value' => '90 MILLION'],
                    ['name' => 'Scroll Wheel','value' => 'Yes'],
                    ['name' => 'Number of buttons','value' => '6 buttons'],
                    ['name' => 'Battery Life','value' => 'None'],
                    ['name' => 'Interface','value' => "USB\nWIRELESS\nWIRED"],
                    ['name' => 'Sensor Resolution','value' => '30,000 DPI'],
                    ['name' => 'Sensor technology','value' => 'Focus Pro 30K Optical'],
                    ['name' => 'Wireless technology','value' => 'Razer HyperSpeed Wireless'],
                    ['name' => 'Color','value' => 'WHITE'],
                    ['name' => 'Warranty','value' => '2 Years'],
                ],
            ],
            [
                'name'     => 'MOUSE CORSAIR SCIMITAR ELITE WIRELESS SE (CH-9314014-AP) (2Y)',
                'sku'      => 'SKU-250837617',
                'category' => ['slug' => 'mouse', 'name' => 'MOUSE'],
                'brand'    => 'CORSAIR',
                'price'    => 4990,
                'attributes' => [
                    ['name' => 'Brand','value' => 'CORSAIR'],
                    ['name' => 'Tilt scroll function','value' => 'N/A'],
                    ['name' => 'Click life span','value' => '100 MILLION'],
                    ['name' => 'Scroll Wheel','value' => 'Yes'],
                    ['name' => 'Macro Keys','value' => 'Yes'],
                    ['name' => 'Number of buttons','value' => '16 buttons'],
                    ['name' => 'Battery Life','value' => 'Up to 150h (2.4G, RGB off) / up to 500h (BT, RGB off)'],
                    ['name' => 'Battery Type','value' => 'Built-in lithium-polymer'],
                    ['name' => 'Interface','value' => 'Wireless / Bluetooth / Wired'],
                    ['name' => 'Sensor Resolution','value' => '33,000 DPI'],
                    ['name' => 'Sensor technology','value' => 'MARKSMAN S 33K'],
                    ['name' => 'Wireless technology','value' => "Wireless 2.4G\nBluetooth 4.2"],
                    ['name' => 'Dimensions','value' => '119.23 x 73.48 x 42.17 mm'],
                    ['name' => 'Color','value' => 'Gun Metal'],
                    ['name' => 'Option','value' => 'N/A'],
                    ['name' => 'Weight','value' => '161 g'],
                    ['name' => 'Warranty','value' => '2 Years'],
                ],
            ],
            [
                'name'     => 'MOUSE LOGITECH G PRO 2 LIGHTSPEED (BLACK) (2Y)',
                'sku'      => 'SKU-240923150',
                'category' => ['slug' => 'mouse', 'name' => 'MOUSE'],
                'brand'    => 'LOGITECH',
                'price'    => 3690,
                'attributes' => [
                    ['name' => 'Brand','value' => 'LOGITECH'],
                    ['name' => 'Tilt scroll function','value' => 'N/A'],
                    ['name' => 'Click life span','value' => 'N/A'],
                    ['name' => 'Scroll Wheel','value' => 'Yes'],
                    ['name' => 'Number of buttons','value' => '5 buttons'],
                    ['name' => 'Battery Life','value' => '95 hours'],
                    ['name' => 'Battery Type','value' => 'N/A'],
                    ['name' => 'Interface','value' => 'WIRELESS'],
                    ['name' => 'Sensor Resolution','value' => '100 – 32,000 DPI'],
                    ['name' => 'Sensor technology','value' => 'HERO 2'],
                    ['name' => 'Wireless technology','value' => 'LIGHTSPEED WIRELESS'],
                    ['name' => 'Dimensions','value' => '125 x 63.5 x 40 mm'],
                    ['name' => 'Color','value' => 'BLACK'],
                    ['name' => 'Warranty','value' => '2 Years'],
                ],
            ],
                ];

                        // ===== Auto image resolver for Mouse =====
        $imageBaseDir = public_path('images/Product/Mouse');
        $imageRelDir  = 'images/Product/Mouse';

        // ใส่ให้ทุกคอลัมน์รูปที่มีจริงในตาราง products
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];


        // สร้าง base ชื่อไฟล์จากชื่อสินค้า (กัน slash/ช่องว่างซ้อน)
        $makeNameBase = function (string $name): string {
            $n = trim($name);
            $n = str_replace(['/', '\\'], '_', $n);
            return preg_replace('/\s+/', ' ', $n);
        };

        // หาไฟล์รูป: 1) มี SKU อยู่ในชื่อไฟล์ 2) ชื่อไฟล์ตรงกับชื่อสินค้า (ตัด prefix ประเภทก็ลอง) 3) ไม่เจอ = null
        $resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir, $makeNameBase): ?string {
            $exts = ['png', 'jpg', 'jpeg', 'webp'];

            // 1) มี SKU อยู่ในชื่อไฟล์ (เช่น "SKU-240923150.png")
            $sku = $item['sku'] ?? '';
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

            // 2) ลองเทียบชื่อไฟล์กับชื่อสินค้า (ทั้งแบบเต็ม และแบบตัด prefix ประเภท)
            $rawName    = $item['name'] ?? '';
            $nameNoType = preg_replace('/^(CASE|CPU|GPU|MOUSE|KEYBOARD|MONITOR|PSU|SSD|RAM)\s+/i', '', $rawName);

            $candidates = array_unique(array_filter([
                $makeNameBase($rawName),
                $makeNameBase($nameNoType),
            ]));

            foreach ($candidates as $base) {
                foreach ($exts as $e) {
                    $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $base . '.' . $e;
                    if (file_exists($abs)) {
                        return $imageRelDir . '/' . $base . '.' . $e;
                    }
                }
            }

            return null;
        };

        foreach ($items as $item) {
            // หมวดหมู่ & แบรนด์
            $category = Category::updateOrCreate(
                ['slug' => $item['category']['slug']],
                ['name' => $item['category']['name'], 'sort_order' => 0]
            );
            $brand = Brand::updateOrCreate(
                ['slug' => Str::slug($item['brand'])],
                ['name' => $item['brand']]
            );

            // ข้อมูลสินค้า
            $payload = [
                'name'        => $item['name'],
                'category_id' => $category->id,
                'brand_id'    => $brand->id,
                'price'       => $item['price'],
            ];
            if (Schema::hasColumn('products', 'status')) {
                $payload['status'] = 'active';
            }

            // ใส่รูปลงทุกคอลัมน์รูปที่มีจริง
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

            // แจ้งเตือนช่วยดีบั๊กถ้าไม่เจอไฟล์
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

            // สต็อกตั้งต้น
            if (Schema::hasTable('stocks')) {
                \App\Models\Stock::updateOrCreate(
                    ['product_id' => $product->id],
                    ['qty' => 100]
                );
            }

            // คุณสมบัติสินค้า
            if (method_exists($product, 'attributes')) {
                $product->attributes()->delete();
                $attrs = array_map(function ($a, $i) {
                    $a['sort_order'] = $a['sort_order'] ?? ($i + 1);
                    return $a;
                }, $item['attributes'], array_keys($item['attributes']));
                $product->attributes()->createMany($attrs);
            }

            // ตาราง images (ถ้ามี)
            if (method_exists($product, 'images') && $imgRel) {
                $product->images()->delete();
                $product->images()->createMany([
                    ['path' => $imgRel, 'sort_order' => 1],
                ]);
            }
        }
    }
}