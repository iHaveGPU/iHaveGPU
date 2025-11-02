<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddPSUSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name'     => 'PSU AEROCOOL UNITED POWER 600W (80+WHITE) (3Y)',
                'sku'      => 'SKU-139685',
                'category' => ['slug' => 'psu', 'name' => 'PSU'],
                'brand'    => 'AEROCOOL',
                'price'    => 1190,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'AEROCOOL'],
                    ['name' => 'Energy Efficient', 'value' => '80 PLUS WHITE'],
                    ['name' => 'Modular', 'value' => 'Non Modular'],
                    ['name' => 'Continuous Power W', 'value' => '600 Watt'],
                    ['name' => 'PSU Form Factor', 'value' => 'ATX'],
                    ['name' => 'Input Current', 'value' => '4.5 A'],
                    ['name' => 'Input Frequency', 'value' => '47-63Hz'],
                    ['name' => 'MB Connector', 'value' => '1 x 20+4-pin'],
                    ['name' => 'CPU Connector', 'value' => '2 x 4+4-pin'],
                    ['name' => 'PCIe Connector', 'value' => '2 x 6+2-pin'],
                    ['name' => 'SATA Connector', 'value' => '4'],
                    ['name' => 'Fan Size', 'value' => '120 mm'],
                    ['name' => 'Dimensions W x D x H', 'value' => '150 x 140 x 86 mm'],
                    ['name' => 'Weight', 'value' => '1.28 KG'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
            [
                'name'     => 'PSU AZZA PSAZ 550W (80+BRONZE) (3Y)',
                'sku'      => 'SKU-12691',
                'category' => ['slug' => 'psu', 'name' => 'PSU'],
                'brand'    => 'AZZA',
                'price'    => 1190,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'AZZA'],
                    ['name' => 'Energy Efficient', 'value' => '80 PLUS BRONZE'],
                    ['name' => 'Continuous Power W', 'value' => '550 Watt'],
                    ['name' => 'PSU Form Factor', 'value' => 'ATX'],
                    ['name' => 'Input Frequency', 'value' => '47-63Hz'],
                    ['name' => 'MB Connector', 'value' => '1 x 20+4-pin'],
                    ['name' => 'CPU Connector', 'value' => '1 x 4+4-Pin'],
                    ['name' => 'PCIe Connector', 'value' => '2 x 6+2-pin'],
                    ['name' => 'SATA Connector', 'value' => '5'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
            [
                'name'     => 'PSU GIGABYTE GP-P750BS 750W (80+BRONZE) (3Y)',
                'sku'      => 'SKU-250431597',
                'category' => ['slug' => 'psu', 'name' => 'PSU'],
                'brand'    => 'GIGABYTE',
                'price'    => 1990,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'GIGABYTE'],
                    ['name' => 'Energy Efficient', 'value' => '80 PLUS BRONZE'],
                    ['name' => 'Modular', 'value' => 'Non Modular'],
                    ['name' => 'Continuous Power W', 'value' => '750 Watt'],
                    ['name' => 'Form Factor', 'value' => 'ATX'],
                    ['name' => 'Input Voltage', 'value' => '200-240 V'],
                    ['name' => 'Input Current', 'value' => '6 A'],
                    ['name' => 'Input Frequency', 'value' => '50-60Hz'],
                    ['name' => 'MB Connector', 'value' => '1 x 20+4-pin'],
                    ['name' => 'CPU Connector', 'value' => '2 x 4+4-pin'],
                    ['name' => 'PCIe Connector', 'value' => '4 x 6+2-pin'],
                    ['name' => 'SATA Connector', 'value' => '7'],
                    ['name' => 'Fan Size', 'value' => '120 mm'],
                    ['name' => 'Dimensions', 'value' => '150 x 140 x 86 mm'],
                    ['name' => 'Protections', 'value' => 'OVP/OPP/SCP/UVP/OCP/OTP'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
            [
                'name'     => 'PSU GIGABYTE UD850GM PG5 V2 850W (80+GOLD)',
                'sku'      => 'SKU-240314132',
                'category' => ['slug' => 'psu', 'name' => 'PSU'],
                'brand'    => 'GIGABYTE',
                'price'    => 4390,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'GIGABYTE'],
                    ['name' => 'Energy Efficient', 'value' => '80 PLUS GOLD'],
                    ['name' => 'Modular', 'value' => 'Fully Modular'],
                    ['name' => 'Continuous Power W', 'value' => '850 Watt'],
                    ['name' => 'PSU Form Factor', 'value' => 'ATX'],
                    ['name' => 'Input Current', 'value' => '12 - 6A'],
                    ['name' => 'Input Frequency', 'value' => '50-60Hz'],
                    ['name' => 'MB Connector', 'value' => '1 x 20+4-pin'],
                    ['name' => 'CPU Connector', 'value' => '2 x 4+4-pin'],
                    ['name' => 'PCIe Connector', 'value' => '4 x 6+2-pin'],
                    ['name' => 'SATA Connector', 'value' => '8'],
                    ['name' => 'Fan Size', 'value' => '120 mm'],
                    ['name' => 'Dimensions W x D x H', 'value' => '140 x 150 x 86 mm'],
                    ['name' => 'Weight', 'value' => '2.5 Kg'],
                    ['name' => 'Protections', 'value' => 'OVP/OPP/SCP/UVP/OCP/OTP'],
                    ['name' => 'Power Range', 'value' => '850W'],
                    ['name' => 'Warranty', 'value' => '5 Years'],
                ],
            ],
            [
                'name'     => 'PSU MSI MAG A1250GL PCIE5 1250W (80+GOLD) (7Y)',
                'sku'      => 'SKU-250938373',
                'category' => ['slug' => 'psu', 'name' => 'PSU'],
                'brand'    => 'MSI',
                'price'    => 6490,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'MSI'],
                    ['name' => 'Energy Efficient', 'value' => '80 PLUS GOLD'],
                    ['name' => 'Modular', 'value' => 'Fully Modular'],
                    ['name' => 'Continuous Power W', 'value' => '1250 Watt'],
                    ['name' => 'Form Factor', 'value' => 'ATX'],
                    ['name' => 'Input Voltage', 'value' => '100-240 V'],
                    ['name' => 'Input Current', 'value' => '15 A'],
                    ['name' => 'Input Frequency', 'value' => '50-60Hz'],
                    ['name' => 'MB Connector', 'value' => '1 x 24-pin'],
                    ['name' => 'CPU Connector', 'value' => '2 x 4+4-pin'],
                    ['name' => 'PCIe Connector', 'value' => "4 x 6+2-pin\n1 x 16-pin"],
                    ['name' => 'SATA Connector', 'value' => '12'],
                    ['name' => 'Molex Connector', 'value' => '4'],
                    ['name' => 'Fan Size', 'value' => '135 mm'],
                    ['name' => 'Dimensions', 'value' => '150 × 150 × 86 mm'],
                    ['name' => 'Protections', 'value' => 'OVP/OPP/SCP/UVP/OCP/OTP'],
                    ['name' => 'Warranty', 'value' => '7 Years'],
                ],
            ],
        ];

        // ===== Auto image resolver for PSU =====
        $imageBaseDir = public_path('images/Product/PSU');
        $imageRelDir  = 'images/Product/PSU';

        // ใส่ให้ทุกคอลัมน์รูปที่มีจริง (รวม cover_image)
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

        // หาไฟล์รูป: 1) มีไฟล์ที่มี SKU อยู่ในชื่อ 2) ใช้ฟิลด์ image ถ้ามี 3) เดาจากชื่อสินค้า
        $makeBaseFromName = function (string $name): string {
            $n = trim($name);
            $n = str_replace(['/', '\\'], '_', $n);
            return preg_replace('/\s+/', ' ', $n);
        };

        $resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir, $makeBaseFromName): ?string {
            $exts = ['png','jpg','jpeg','webp'];
            $sku  = $item['sku'] ?? '';

            // 1) หาจากไฟล์ที่มี SKU อยู่ในชื่อ
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
            $base = $makeBaseFromName($item['name'] ?? '');
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

            // เตือนช่วย debug ถ้าไฟล์ไม่พบ
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

            // stock เริ่มต้น (PSU ผมตั้งไว้ 0)
            if (Schema::hasTable('stocks')) {
                \App\Models\Stock::updateOrCreate(
                    ['product_id' => $product->id],
                    ['qty' => 0]
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
