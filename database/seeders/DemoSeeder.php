<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Ensure Category "CPU"
        $category = Category::updateOrCreate(
            ['slug' => 'cpu'],
            ['name' => 'CPU', 'sort_order' => 0]
        );

        // 2) Ensure Brand "AMD"
        $brand = Brand::updateOrCreate(
            ['slug' => 'amd'],
            ['name' => 'AMD']
        );

        // 3) Create / Update Product by unique SKU
        $sku   = 'SKU-140594';
        $name  = 'AMD AM4 RYZEN 5 5500 3.6GHz 6C 12T';
        $price = 2990; // THB

        /** @var \App\Models\Product $product */
        $product = Product::updateOrCreate(
            ['sku' => $sku],
            [
                'name'        => $name,
                'category_id' => $category->id,
                'brand_id'    => $brand->id,
                'price'       => $price,
                // ใส่สถานะถ้ามีคอลัมน์ status
                'status'      => Schema::hasColumn('products', 'status') ? 'active' : null,
                // รูปยังไม่ใส่ (อัพโหลดทีหลัง)
                'cover_image' => null,
            ]
        );

        // 4) Initial Stock = 1000 (ถ้ามีตาราง stocks)
        if (Schema::hasTable('stocks')) {
            \App\Models\Stock::updateOrCreate(
                ['product_id' => $product->id],
                ['qty' => 1000]
            );
        }

        // 5) Optional: เติมคุณสมบัติ (ถ้าโมเดล Product มีความสัมพันธ์ attributes())
        $attributes = [
            ['name' => 'Brand',                'value' => 'AMD',                               'sort_order' => 1],
            ['name' => 'Series',               'value' => '5000 Series',                       'sort_order' => 2],
            ['name' => 'Processor Number',     'value' => 'Ryzen 5 5500',                      'sort_order' => 3],
            ['name' => 'Socket Type',          'value' => 'AM4',                               'sort_order' => 4],
            ['name' => 'Cores/Threads',        'value' => '6 Cores / 12 Threads',              'sort_order' => 5],
            ['name' => 'Base Frequency',       'value' => '3.6 GHz',                           'sort_order' => 6],
            ['name' => 'Max Turbo Frequency',  'value' => '4.2 GHz',                           'sort_order' => 7],
            ['name' => 'L2 Cache',             'value' => '3 MB',                              'sort_order' => 8],
            ['name' => 'L3 Cache',             'value' => '16 MB',                             'sort_order' => 9],
            ['name' => 'Graphics Models',      'value' => 'Discrete Graphics Card Required',   'sort_order' => 10],
            ['name' => '64Bit Support',        'value' => 'N/A',                               'sort_order' => 11],
            ['name' => 'CPU Cooler',           'value' => 'Yes',                               'sort_order' => 12],
            ['name' => 'Default TDP',          'value' => '65W',                               'sort_order' => 13],
            ['name' => 'Warranty',             'value' => '3 Years',                           'sort_order' => 14],
        ];

        if (method_exists($product, 'attributes')) {
            // ลบของเดิมที่ชื่อซ้ำแล้วเติมใหม่แบบ upsert ง่าย ๆ
            $product->attributes()->delete();
            $product->attributes()->createMany($attributes);
        }
    }
}
