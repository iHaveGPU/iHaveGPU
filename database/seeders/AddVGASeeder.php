<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddVGASeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // 1) PowerColor RX 6500 XT
            [
                'name'     => 'POWERCOLOR FIGHTER RADEON RX 6500 XT - 4GB GDDR6 V3 (AXRX 6500XT 4GBD6-DHV3) (3Y)',
                'sku'      => 'SKU-250533399',
                'category' => ['slug' => 'gpu', 'name' => 'GPU'],
                'brand'    => 'POWER COLOR',
                'price'    => 4590.00,
                'attributes' => [
                    ['name' => 'Brands',                'value' => 'POWER COLOR'],
                    ['name' => 'GPU Series',            'value' => 'AMD Radeon™ RX 6000 Series'],
                    ['name' => 'GPU Model',             'value' => 'Radeon™ RX 6500 XT'],
                    ['name' => 'Memory Size',           'value' => '4GB GDDR6'],
                    ['name' => 'Bus Standards',         'value' => 'PCI Express 4.0 x4'],
                    ['name' => 'OpenGL',                'value' => 'OpenGL® 4.6'],
                    ['name' => 'CUDA® Cores',           'value' => '1024'],
                    ['name' => 'Memory Interface',      'value' => '64-bit'],
                    ['name' => 'Boost Clock',           'value' => '2815 MHz (OC mode)'],
                    ['name' => 'Memory Clock',          'value' => '18.0 Gbps'],
                    ['name' => 'Max Digital Resolution','value' => '7680 x 4320'],
                    ['name' => 'HDMI Port',             'value' => '1 x HDMI 2.1'],
                    ['name' => 'Display Port',          'value' => '1x DisplayPort™ 1.4'],
                    ['name' => 'Power Connector',       'value' => '1 x 6-pin'],
                    ['name' => 'Power Requirement',     'value' => '400 Watt'],
                    ['name' => 'Dimension',             'value' => '192 x 127 x 42 mm'],
                    ['name' => 'Warranty',              'value' => '3 Years'],
                ],
            ],

            // 2) INNO3D RTX 3050 Twin X2 V2 6GB
            [
                'name'     => 'INNO3D GEFORCE RTX 3050 TWIN X2 V2 - 6GB GDDR6 (N30502-06D6-1880VA60) (3Y)',
                'sku'      => 'SKU-250837815',
                'category' => ['slug' => 'gpu', 'name' => 'GPU'],
                'brand'    => 'INNO3D',
                'price'    => 5590.00,
                'attributes' => [
                    ['name' => 'Brands',                'value' => 'INNO3D'],
                    ['name' => 'GPU Series',            'value' => 'NVIDIA GeForce RTX™ 30 Series'],
                    ['name' => 'GPU Model',             'value' => 'GeForce RTX™ 3050'],
                    ['name' => 'Memory Size',           'value' => '6GB GDDR6'],
                    ['name' => 'Bus Standards',         'value' => 'PCI Express 4.0 x16'],
                    ['name' => 'OpenGL',                'value' => 'OpenGL® 4.6'],
                    ['name' => 'CUDA® Cores',           'value' => '2304'],
                    ['name' => 'Memory Interface',      'value' => '96-bit'],
                    ['name' => 'Boost Clock',           'value' => '1470 MHz'],
                    ['name' => 'Base Clock',            'value' => '1042 MHz'],
                    ['name' => 'Memory Clock',          'value' => '14.0 Gbps'],
                    ['name' => 'Max Digital Resolution','value' => '7680 x 4320'],
                    ['name' => 'HDMI Port',             'value' => '1 x HDMI 2.1'],
                    ['name' => 'Display Port',          'value' => '1x DisplayPort™ 1.4a'],
                    ['name' => 'DVI Port',              'value' => '1 x DVI-D'],
                    ['name' => 'Power Connector',       'value' => 'N/A'],
                    ['name' => 'Power Requirement',     'value' => '450 Watt'],
                    ['name' => 'Dimension',             'value' => '222 x 120 x 40 mm'],
                    ['name' => 'Warranty',              'value' => '3 Years'],
                ],
            ],

            // 3) MSI RTX 3050 Ventus 2X E 6G OC
            [
                'name'     => 'MSI GEFORCE RTX 3050 VENTUS 2X E 6G OC - 6GB GDDR6 (3Y)',
                'sku'      => 'SKU-250127777',
                'category' => ['slug' => 'gpu', 'name' => 'GPU'],
                'brand'    => 'MSI',
                'price'    => 5690.00,
                'attributes' => [
                    ['name' => 'Brands',                'value' => 'MSI'],
                    ['name' => 'GPU Series',            'value' => 'NVIDIA GeForce RTX™ 30 Series'],
                    ['name' => 'GPU Model',             'value' => 'GeForce RTX™ 3050'],
                    ['name' => 'Memory Size',           'value' => '6GB GDDR6'],
                    ['name' => 'Bus Standards',         'value' => 'PCI Express 4.0 x16'],
                    ['name' => 'OpenGL',                'value' => 'OpenGL® 4.6'],
                    ['name' => 'CUDA® Cores',           'value' => '2304'],
                    ['name' => 'Memory Interface',      'value' => '96-bit'],
                    ['name' => 'Boost Clock',           'value' => '1492 MHz'],
                    ['name' => 'Base Clock',            'value' => '1042 MHz'],
                    ['name' => 'Memory Clock',          'value' => '14.0 Gbps'],
                    ['name' => 'Max Digital Resolution','value' => '7680 x 4320'],
                    ['name' => 'HDMI Port',             'value' => '2 x HDMI 2.1a'],
                    ['name' => 'Display Port',          'value' => '1x DisplayPort™ 1.4a'],
                    ['name' => 'Power Connector',       'value' => 'N/A'],
                    ['name' => 'Power Requirement',     'value' => '300 Watt'],
                    ['name' => 'Dimension',             'value' => '189 x 109 x 42 mm'],
                    ['name' => 'Warranty',              'value' => '3 Years'],
                ],
            ],

            // 4) GIGABYTE RTX 3050 WINDFORCE OC V2 6G
            [
                'name'     => 'GIGABYTE GEFORCE RTX 3050 WINDFORCE OC V2 6G - 6GB GDDR6 (GV-N3050WF2OCV2-6GD) (3Y)',
                'sku'      => 'SKU-250127778',
                'category' => ['slug' => 'gpu', 'name' => 'GPU'],
                'brand'    => 'GIGABYTE',
                'price'    => 5690.00,
                'attributes' => [
                    ['name' => 'Brands',                'value' => 'GIGABYTE'],
                    ['name' => 'GPU Series',            'value' => 'NVIDIA GeForce RTX™ 30 Series'],
                    ['name' => 'GPU Model',             'value' => 'GeForce RTX™ 3050'],
                    ['name' => 'Memory Size',           'value' => '6GB GDDR6'],
                    ['name' => 'Bus Standards',         'value' => 'PCI Express 4.0'],
                    ['name' => 'OpenGL',                'value' => 'OpenGL® 4.6'],
                    ['name' => 'CUDA® Cores',           'value' => '2304'],
                    ['name' => 'Memory Interface',      'value' => '96-bit'],
                    ['name' => 'Boost Clock',           'value' => '1477 MHz (Reference Card : 1470 MHz)'],
                    ['name' => 'Base Clock',            'value' => '1042 MHz'],
                    ['name' => 'Memory Clock',          'value' => '14.0 Gbps'],
                    ['name' => 'Max Digital Resolution','value' => '7680 x 4320'],
                    ['name' => 'HDMI Port',             'value' => '2 x HDMI 2.1'],
                    ['name' => 'Display Port',          'value' => '2x DisplayPort™ 1.4a'],
                    ['name' => 'Power Connector',       'value' => 'N/A'],
                    ['name' => 'Power Requirement',     'value' => '300 Watt'],
                    ['name' => 'Dimension',             'value' => '191 x 111 x 36 mm'],
                    ['name' => 'Warranty',              'value' => '3 Years'],
                ],
            ],

            // 5) XFX RX 7600
            [
                'name'     => 'XFX SPEEDSTER SWFT210 RADEON RX 7600 CORE - 8GB GDDR6 (RX-76PSWFTFY) (3Y)',
                'sku'      => 'SKU-09983',
                'category' => ['slug' => 'gpu', 'name' => 'GPU'],
                'brand'    => 'XFX',
                'price'    => 7990.00,
                'attributes' => [
                    ['name' => 'Brands',                'value' => 'XFX'],
                    ['name' => 'GPU Series',            'value' => 'AMD Radeon™ RX 7000 Series'],
                    ['name' => 'GPU Model',             'value' => 'Radeon™ RX 7600'],
                    ['name' => 'Memory Size',           'value' => '8GB GDDR6'],
                    ['name' => 'Bus Standards',         'value' => 'PCI Express 4.0'],
                    ['name' => 'CUDA® Cores',           'value' => '2048'],
                    ['name' => 'Memory Interface',      'value' => '128-bit'],
                    ['name' => 'Boost Clock',           'value' => '2655 MHz'],
                    ['name' => 'Base Clock',            'value' => '1875 MHz'],
                    ['name' => 'Memory Clock',          'value' => '18.0 Gbps'],
                    ['name' => 'Max Digital Resolution','value' => '7680 x 4320'],
                    ['name' => 'HDMI Port',             'value' => '1 x HDMI 2.1'],
                    ['name' => 'Display Port',          'value' => '3x DisplayPort™ 2.1'],
                    ['name' => 'Power Connector',       'value' => '1 x 8-pin'],
                    ['name' => 'Power Requirement',     'value' => '550 Watt'],
                    ['name' => 'Dimension',             'value' => '241 x 131 x 41 mm'],
                    ['name' => 'Warranty',              'value' => '3 Years'],
                ],
            ],
        ];

        // ===== Auto image resolver for VGA =====
        $imageBaseDir = public_path('images/Product/VGA');
        $imageRelDir  = 'images/Product/VGA';

        // เติมให้ทุกคอลัมน์รูปที่มีจริง (รวม cover_image)
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

        // ทำ basename ให้ใกล้ชื่อไฟล์จริง
        $makeBasename = function (string $name): string {
            $n = trim($name);
            $n = str_replace(['/', '\\'], '_', $n); // กันสแลช
            return preg_replace('/\s+/', ' ', $n);  // เว้นวรรคซ้ำ -> ช่องเดียว
        };

        // หาไฟล์รูป: 1) มี SKU ในชื่อไฟล์ 2) ใช้ field image ถ้ามีและไฟล์อยู่จริง 3) เดาจากชื่อ 3.1) ค้นหาแบบไม่สน case
        $resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir, $makeBasename): ?string {
            $exts = ['png', 'jpg', 'jpeg', 'webp'];
            $sku  = $item['sku'] ?? '';

            // 1) สแกนไฟล์ที่มี SKU อยู่ในชื่อ
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

            // 3.1) ค้นหาแบบไม่สนตัวพิมพ์เล็กใหญ่
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

            // รูป: เติมลงทุกคอลัมน์รูปที่มีจริง
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

            // เตือนช่วย debug
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

            // สต็อกตั้งต้น (GPU = 0)
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
