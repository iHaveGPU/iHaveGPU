<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddCaseSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name'     => 'CASE HYTE Y70 14.9 TOUCH INFINITE (BLACK/BLACK) (3Y)',
                'sku'      => 'SKU-250228921',
                'category' => ['slug' => 'case', 'name' => 'CASE'],
                'brand'    => 'HYTE',
                'price'    => 16490,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'HYTE'],
                    ['name' => 'Model', 'value' => 'Y70 TOUCH'],
                    ['name' => 'Form Factor', 'value' => 'Mid-Tower'],
                    ['name' => 'Mainboard Support', 'value' => "E-ATX\nATX\nMini-ITX\nMicro-ATX"],
                    ['name' => 'VGA Support', 'value' => '422mm'],
                    ['name' => 'CPU Cooler Support', 'value' => '180mm'],
                    ['name' => 'Power Supply Support', 'value' => 'ATX, SFX, SFX - L'],
                    ['name' => 'Front I/O', 'value' => "1 x USB-C 3.2 Gen 2\n2 x USB-A 3.2 Gen 1\n1 x Audio Out / Mic-in"],
                    ['name' => 'Expansion Slots', 'value' => '7 Slots + 4 Vertical'],
                    ['name' => 'Drive Bays Support', 'value' => '3.5\" x 2 , 2.5\" x 4'],
                    ['name' => 'Fan Installment', 'value' => 'NONE'],
                    ['name' => 'Fan Support', 'value' => "Top : 3 x 120mm or 2 x 140mm\nSide : 3 x 120mm or 2 x 140mm\nRear : 1 x 120mm or 1 x 140mm\nBottom : 3 x 120mm or 2 x 140mm"],
                    ['name' => 'Radiator Support', 'value' => "Top : 120,140,240,280,360mm\nSide : 120,140,240,280,360mm\nRear : 120,140mm"],
                    ['name' => 'Color', 'value' => 'BLACK'],
                    ['name' => 'Dimensions D x W x H', 'value' => '470 x 320 x 470 mm'],
                    ['name' => 'Weight', 'value' => '12.9 kg'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
            [
                'name'     => 'CASE HYTE Y70 WITH RISER NON LCD (BLACK/BLACK) (E-ATX) (3Y)',
                'sku'      => 'SKU-240518691',
                'category' => ['slug' => 'case', 'name' => 'CASE'],
                'brand'    => 'HYTE',
                'price'    => 7490,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'HYTE'],
                    ['name' => 'Model', 'value' => 'Y70'],
                    ['name' => 'Form Factor', 'value' => 'Mid-Tower'],
                    ['name' => 'VGA Support', 'value' => '422mm'],
                    ['name' => 'Mainboard Support', 'value' => "E-ATX\nATX\nMini-ITX\nMicro-ATX"],
                    ['name' => 'CPU Cooler Support', 'value' => '180mm'],
                    ['name' => 'Power Supply Support', 'value' => 'ATX PSU'],
                    ['name' => 'Front I/O', 'value' => "1 x USB-C 3.2 Gen 2\n2 x USB-A 3.2 Gen 1\n1 x Audio Out / Mic-in"],
                    ['name' => 'Expansion Slots', 'value' => '7 Slots + 4 Vertical'],
                    ['name' => 'Drive Bays Support', 'value' => '3.5\" x2 , 2.5\" x4'],
                    ['name' => 'Fan Installment', 'value' => 'NONE'],
                    ['name' => 'Fan Support', 'value' => "Top : 3 x 120mm or 2 x 140mm\nSide : 3 x 120mm or 2 x 140mm\nRear : 1 x 140mm"],
                    ['name' => 'Radiator Support', 'value' => "Top : 120,140,240,280,360mm\nSide : 120,140,240,280,360mm\nRear : 120,140mm"],
                    ['name' => 'Color', 'value' => 'BLACK'],
                    ['name' => 'Dimensions D x W x H', 'value' => '470 x 320 x 470 mm'],
                    ['name' => 'Weight', 'value' => '11.62 kg'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
            [
                'name'     => 'CASE HYTE Y70 WITH RISER NON LCD STRAWBERRY MILK (PINK) (E-ATX) (3Y)',
                'sku'      => 'SKU-241125020',
                'category' => ['slug' => 'case', 'name' => 'CASE'],
                'brand'    => 'HYTE',
                'price'    => 7490,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'HYTE'],
                    ['name' => 'Model', 'value' => 'Y70'],
                    ['name' => 'Form Factor', 'value' => 'Mid-Tower'],
                    ['name' => 'Mainboard Support', 'value' => "E-ATX\nATX\nMini-ITX\nMicro-ATX"],
                    ['name' => 'VGA Support', 'value' => '422mm'],
                    ['name' => 'CPU Cooler Support', 'value' => '180mm'],
                    ['name' => 'Power Supply Support', 'value' => 'ATX PSU'],
                    ['name' => 'Front I/O', 'value' => "1 x USB-C 3.2 Gen 2\n2 x USB-A 3.2 Gen 1\n1 x 3.5mm combo headphone with microphone jack"],
                    ['name' => 'Expansion Slots', 'value' => '7 Slots + 4 Vertical'],
                    ['name' => 'Drive Bays Support', 'value' => '3.5\" x2 , 2.5\" x4'],
                    ['name' => 'Fan Installment', 'value' => 'NONE'],
                    ['name' => 'Fan Support', 'value' => "Top : 3 x 120mm or 2 x 140mm\nSide : 3 x 120mm or 2 x 140mm\nRear : 1 x 120mm or 1 x 140mm\nBottom : 3 x 120mm or 2 x 140mm"],
                    ['name' => 'Radiator Support', 'value' => "Top : 120,140,240,280,360mm\nSide : 120,140,240,280,360mm\nRear : 120,140mm"],
                    ['name' => 'Color', 'value' => 'PINK'],
                    ['name' => 'Dimensions D x W x H', 'value' => '470 x 320 x 470 mm'],
                    ['name' => 'Weight', 'value' => '11.62 kg'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
            [
                'name'     => 'CASE HYTE Y70 WITH RISER NON LCD MATCHA MILK (GREEN) (E-ATX) (3Y)',
                'sku'      => 'SKU-250938356',
                'category' => ['slug' => 'case', 'name' => 'CASE'],
                'brand'    => 'HYTE',
                'price'    => 7490,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'HYTE'],
                    ['name' => 'Model', 'value' => 'Y70'],
                    ['name' => 'Form Factor', 'value' => 'Mid-Tower'],
                    ['name' => 'Mainboard Support', 'value' => "E-ATX\nATX\nMini-ITX\nMicro-ATX"],
                    ['name' => 'VGA Support', 'value' => '422mm'],
                    ['name' => 'CPU Cooler Support', 'value' => '180mm'],
                    ['name' => 'Power Supply Support', 'value' => 'ATX PSU'],
                    ['name' => 'Front I/O', 'value' => "1 x USB-C 3.2 Gen 2\n2 x USB-A 3.2 Gen 1\n1 x Audio Out / Mic-in"],
                    ['name' => 'Expansion Slots', 'value' => '7 Slots + 4 Vertical'],
                    ['name' => 'Drive Bays Support', 'value' => '3.5\"/2.5\" x2 , 2.5\" x4'],
                    ['name' => 'Fan Installment', 'value' => 'NONE'],
                    ['name' => 'Fan Support', 'value' => "Top : 3 x 120mm or 2 x 140mm\nSide : 3 x 120mm or 2 x 140mm\nRear : 1 x 120mm or 1 x 140mm\nBottom : 3 x 120mm or 2 x 140mm"],
                    ['name' => 'Radiator Support', 'value' => "Top : 120,140,240,280,360mm\nSide : 120,140,240,280,360mm\nRear : 120,140mm"],
                    ['name' => 'Color', 'value' => 'MATCHA GREEN'],
                    ['name' => 'Dimensions D x W x H', 'value' => '470 x 320 x 470 mm'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
            [
                'name'     => 'CASE HYTE Y60 (BLACK/RED) (E-ATX)',
                'sku'      => 'SKU-15008',
                'category' => ['slug' => 'case', 'name' => 'CASE'],
                'brand'    => 'HYTE',
                'price'    => 6590,
                'attributes' => [
                    ['name' => 'Brand', 'value' => 'HYTE'],
                    ['name' => 'Model', 'value' => 'Y60'],
                    ['name' => 'Form Factor', 'value' => 'Mid-Tower'],
                    ['name' => 'VGA Support', 'value' => '375mm'],
                    ['name' => 'Mainboard Support', 'value' => "E-ATX\nATX\nMini-ITX\nMicro-ATX"],
                    ['name' => 'CPU Cooler Support', 'value' => '160mm'],
                    ['name' => 'Power Supply Support', 'value' => 'ATX PSU'],
                    ['name' => 'Front I/O', 'value' => "2 x USB-A 3.0\n1 x USB-C 3.2 Gen 2\n1 x Audio Out / Mic-in"],
                    ['name' => 'Expansion Slots', 'value' => '7 Slots + 3 Vertical'],
                    ['name' => 'Drive Bays Support', 'value' => '3.5\" x2 , 2.5\" x4'],
                    ['name' => 'Fan Installment', 'value' => '120mm x3 Fans'],
                    ['name' => 'Fan Support', 'value' => "Top : 3 x 120mm\nSide : 2 x 120mm or 2 x 140mm\nRear : 1 x 120mm\nBottom : 2 x 120mm or 2 x 140mm"],
                    ['name' => 'Radiator Support', 'value' => "Top : 120,240,360mm\nSide : 120,140,240,280mm\nRear : 120mm"],
                    ['name' => 'Color', 'value' => 'BLACK & RED'],
                    ['name' => 'Dimensions D x W x H', 'value' => '456 x 285 x 462 mm'],
                    ['name' => 'Weight', 'value' => '9.6 kg'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
        ];

        // ===== รูป: ใช้ชื่อไฟล์ = SKU (เช่น SKU-240518691.png) =====
        $imageBaseDir = public_path('images/Product/Case');
        $imageRelDir  = 'images/Product/Case';
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

        $resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir): ?string {
            $exts = ['png','jpg','jpeg','webp','jfif'];
            $sku  = $item['sku'] ?? '';

            // 1) SKU.ext ตรงตัว
            if ($sku && is_dir($imageBaseDir)) {
                foreach ($exts as $e) {
                    $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $sku . '.' . $e;
                    if (file_exists($abs)) {
                        return $imageRelDir . '/' . $sku . '.' . $e;
                    }
                }
                // 1.1) เผื่อไฟล์มี prefix/suffix รอบ SKU
                foreach (scandir($imageBaseDir) ?: [] as $f) {
                    if ($f === '.' || $f === '..') continue;
                    $p   = $imageBaseDir . DIRECTORY_SEPARATOR . $f;
                    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                    if (is_file($p) && in_array($ext, $exts, true) && stripos($f, $sku) !== false) {
                        return $imageRelDir . '/' . $f;
                    }
                }
            }

            // 2) เดาจากชื่อ (fallback เผื่อยังไม่ได้เปลี่ยนชื่อไฟล์เป็น SKU)
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
            // หมวด/แบรนด์
            $category = Category::updateOrCreate(
                ['slug' => $item['category']['slug']],
                ['name' => $item['category']['name'], 'sort_order' => 0]
            );
            $brand = Brand::updateOrCreate(
                ['slug' => Str::slug($item['brand'])],
                ['name' => $item['brand']]
            );

            // payload หลัก
            $payload = [
                'name'        => $item['name'],
                'category_id' => $category->id,
                'brand_id'    => $brand->id,
                'price'       => $item['price'],
            ];
            if (Schema::hasColumn('products', 'status')) {
                $payload['status'] = 'active';
            }

            // ใส่รูปลงทุกคอลัมน์รูปที่มีจริง (รวม cover_image)
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

            // แจ้งเตือนถ้าไฟล์ขาด
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

            // stock เริ่มต้น
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

            // images relation (ถ้ามีความสัมพันธ์นี้ในโมเดล)
            if (method_exists($product, 'images') && $imgRel) {
                $product->images()->delete();
                $product->images()->createMany([
                    ['path' => $imgRel, 'sort_order' => 1],
                ]);
            }
        }
    }
}
