<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddKeyboardSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // 1) FANTECH K514 (EN/TH)
            [
                'name'     => 'KEYBOARD FANTECH K514 (EN/TH)',
                'sku'      => 'SKU-14284',
                'category' => ['slug' => 'keyboard', 'name' => 'KEYBOARD'],
                'brand'    => 'FANTECH',
                'price'    => 250,
                'attributes' => [
                    ['name' => 'Brand',            'value' => 'FANTECH'],
                    ['name' => 'Connectivity',     'value' => 'USB'],
                    ['name' => 'Lighting',         'value' => 'RGB'],
                    ['name' => 'Localization',     'value' => 'EN/TH'],
                    ['name' => 'Dimension',        'value' => '455 x 150 x 30 mm.'],
                    ['name' => 'Weight',           'value' => '0.5 kg'],
                    ['name' => 'Type',             'value' => 'MEMBRANE'],
                    ['name' => 'WIRED/WIRELESS',   'value' => 'WIRED'],
                    ['name' => 'Warranty',         'value' => '2 Years'],
                ],
            ],

            // 2) LOGITECH K120 USB (BLACK) (TH)
            [
                'name'     => 'KEYBOARD LOGITECH K120 USB (BLACK) (TH)',
                'sku'      => 'SKU-08924',
                'category' => ['slug' => 'keyboard', 'name' => 'KEYBOARD'],
                'brand'    => 'LOGITECH',
                'price'    => 279,
                'attributes' => [
                    ['name' => 'Brand',            'value' => 'LOGITECH'],
                    ['name' => 'Connectivity',     'value' => 'USB'],
                    ['name' => 'Localization',     'value' => 'EN/TH'],
                    ['name' => 'Dimension',        'value' => '450 x 155 x 23.5 mm.'],
                    ['name' => 'Weight',           'value' => '0.55 kg'],
                    ['name' => 'Type',             'value' => 'MEMBRANE'],
                    ['name' => 'WIRED/WIRELESS',   'value' => 'WIRED'],
                    ['name' => 'Warranty',         'value' => '3 Years'],
                ],
            ],

            // 3) MOFII SWEET K WIRED RETRO (OFFWHITE) (EN/TH)
            [
                'name'     => 'KEYBOARD MOFII SWEET K WIRED RETRO (OFFWHITE) (EN/TH) (1Y)',
                'sku'      => 'SKU-250127201',
                'category' => ['slug' => 'keyboard', 'name' => 'KEYBOARD'],
                'brand'    => 'MOFII',
                'price'    => 310,
                'attributes' => [
                    ['name' => 'Brand',            'value' => 'MOFII'],
                    ['name' => 'Connectivity',     'value' => 'WIRED'],
                    ['name' => 'Localization',     'value' => 'EN/TH'],
                    ['name' => 'Material',         'value' => 'ABS'],
                    ['name' => 'Dimensions',       'value' => '445 x 136 x 35 mm.'],
                    ['name' => 'Weight',           'value' => '0.65 kg'],
                    ['name' => 'Color',            'value' => 'OFF WHITE'],
                    ['name' => 'Type',             'value' => 'RUBBER DOME'],
                    ['name' => 'WIRED/WIRELESS',   'value' => 'WIRED'],
                    ['name' => 'Warranty',         'value' => '1 Year'],
                ],
            ],

            // 4) MOFII WAFFLE BLUETOOTH (GREY) (EN)
            [
                'name'     => 'KEYBOARD MOFII WAFFLE BLUETOOTH (GREY) (EN) (1Y)',
                'sku'      => 'SKU-250127195',
                'category' => ['slug' => 'keyboard', 'name' => 'KEYBOARD'],
                'brand'    => 'MOFII',
                'price'    => 640,
                'attributes' => [
                    ['name' => 'Brand',                   'value' => 'MOFII'],
                    ['name' => 'Connectivity',            'value' => 'BLUETOOTH'],
                    ['name' => 'Localization',            'value' => 'EN'],
                    ['name' => 'Material',                'value' => 'ABS'],
                    ['name' => 'Battery Type and Quantity','value' => '2 x AAA'],
                    ['name' => 'Dimensions',              'value' => '320 x 137 x 32 mm.'],
                    ['name' => 'Weight',                  'value' => '0.46 kg'],
                    ['name' => 'Color',                   'value' => 'GRAY'],
                    ['name' => 'Warranty',                'value' => '1 Year'],
                ],
            ],

            // 5) STEELSERIES APEX PRO GEN3 TKL (WHITE) (US)
            [
                'name'     => 'KEYBOARD STEELSERIES APEX PRO GEN3 TKL (OMNIPOINT 3.0) + MAGNETIC WRIST REST (WHITE) (US) (2Y)',
                'sku'      => 'SKU-250634942',
                'category' => ['slug' => 'keyboard', 'name' => 'KEYBOARD'],
                'brand'    => 'STEELSERIES',
                'price'    => 9990,
                'attributes' => [
                    ['name' => 'Brand',            'value' => 'STEELSERIES'],
                    ['name' => 'Switch Name',      'value' => 'OMNIPOINT 3.0 ADJUSTABLE HYPERMAGNETIC SWITCH'],
                    ['name' => 'Connectivity',     'value' => 'WIRED'],
                    ['name' => 'Lighting',         'value' => 'Per Key RGB Illumination'],
                    ['name' => 'Localization',     'value' => 'EN'],
                    ['name' => 'Dimensions',       'value' => '355 x 129 x 42 mm.'],
                    ['name' => 'Weight',           'value' => '1.4 kg'],
                    ['name' => 'Color',            'value' => 'WHITE'],
                    ['name' => 'USB Port',         'value' => 'USB Type C'],
                    ['name' => 'Type',             'value' => 'MECHANICAL KEYBOARD'],
                    ['name' => 'WIRED/WIRELESS',   'value' => 'WIRED'],
                    ['name' => 'Warranty',         'value' => '2 Years'],
                ],
            ],
        ];

        // ===== รูป: ใช้ชื่อไฟล์ = SKU (เช่น SKU-08924.png) =====
        $imageBaseDir = public_path('images/Product/Keyboard');
        $imageRelDir  = 'images/Product/Keyboard';
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

        // หารูปจาก SKU ก่อน, ถ้าไม่เจอค่อย fallback
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

            // 2) fallback จากชื่อสินค้า (กรณีไฟล์ยังไม่ได้เปลี่ยนชื่อเป็น SKU)
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

            // ใส่รูปลงทุกคอลัมน์รูปที่ "มีจริง" (รวม cover_image)
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

            // เตือนถ้ารูปไม่พบ (ช่วยดีบั๊ก)
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
