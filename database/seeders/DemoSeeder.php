<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\{Category, Brand, Product, Stock};
use App\Models\Article;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        /* =========================
         * 0) Users (admin / staff / customer)
         *    - ยิงตรง DB เพื่อให้ใส่ password ตอน INSERT แน่นอน
         *    - รหัสผ่านเริ่มต้น: "password"
         * ========================= */
        if (Schema::hasTable('users')) {
            $hasRole            = Schema::hasColumn('users', 'role');
            $hasIsAdmin         = Schema::hasColumn('users', 'is_admin');
            $hasEmailVerifiedAt = Schema::hasColumn('users', 'email_verified_at');

            $insertIfMissing = function (string $name, string $email, ?string $role = null, bool $isAdmin = false) use ($hasRole, $hasIsAdmin, $hasEmailVerifiedAt) {
                $exists = DB::table('users')->where('email', $email)->exists();
                if (! $exists) {
                    $row = [
                        'name'       => $name,
                        'email'      => $email,
                        'password'   => Hash::make('password'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    if ($hasRole && $role)   $row['role']     = $role;
                    if ($hasIsAdmin)         $row['is_admin'] = $isAdmin;
                    if ($hasEmailVerifiedAt) $row['email_verified_at'] = now();

                    DB::table('users')->insert($row);
                } else {
                    // อัปเดตชื่อ/role/is_admin/verified ถ้าจำเป็น (ไม่แตะ password เดิม)
                    $update = ['name' => $name, 'updated_at' => now()];
                    if ($hasRole && $role)   $update['role']     = $role;
                    if ($hasIsAdmin)         $update['is_admin'] = $isAdmin;
                    if ($hasEmailVerifiedAt) {
                        $verified = DB::table('users')->where('email', $email)->value('email_verified_at');
                        if (empty($verified)) $update['email_verified_at'] = now();
                    }
                    DB::table('users')->where('email', $email)->update($update);
                }
            };

            // ✔ บัญชีตัวอย่าง
            $insertIfMissing('Admin',    'admin@example.com',    $hasRole ? 'admin'    : null, true);
            $insertIfMissing('Staff',    'staff@example.com',    $hasRole ? 'staff'    : null, false);
            $insertIfMissing('Customer', 'customer@example.com', $hasRole ? 'customer' : null, false);
        }

        /* =========================
         * 1) Categories (กันซ้ำด้วย slug)
         * ========================= */
        $catNames = ['CPU','Mainboard','GPU','RAM','SSD','HDD','PSU','Case','Notebook','Monitor'];
        $hasCategoryStatus = Schema::hasColumn('categories', 'status');

        foreach ($catNames as $i => $name) {
            $slug    = Str::slug($name);
            $payload = ['name' => $name, 'sort_order' => $i];
            if ($hasCategoryStatus) $payload['status'] = 'active';

            Category::updateOrCreate(['slug' => $slug], $payload);
        }

        /* =========================
         * 2) Brands (สุ่ม 10 รายการ หรือ fallback)
         * ========================= */
        if (class_exists(\Database\Factories\BrandFactory::class)) {
            Brand::factory()->count(10)->create();
        } else {
            $brandNames = ['Aorus','Asus','MSI','Gigabyte','Zotac','Sapphire','PNY','PowerColor','ASRock','Lenovo'];
            foreach ($brandNames as $bn) {
                Brand::updateOrCreate(['slug' => Str::slug($bn)], ['name' => $bn]);
            }
        }

        /* =========================
         * 3) Products + stock + attributes + cover
         * ========================= */
        $placeholder = base_path('resources/seed/placeholder.jpg'); // ใส่ไฟล์เองได้ (optional)
        $categoryIds = Category::pluck('id')->all();
        $brandIds    = Brand::pluck('id')->all();

        if (class_exists(\Database\Factories\ProductFactory::class)) {
            Product::factory()->count(40)->make()->each(function (Product $p) use ($categoryIds, $brandIds, $placeholder) {
                $this->persistDemoProduct($p, $categoryIds, $brandIds, $placeholder);
            });
        } else {
            for ($i = 1; $i <= 40; $i++) {
                $p = new Product();
                $p->name  = 'Demo Product '.$i;
                $p->sku   = 'DEMO-'.str_pad((string)$i, 4, '0', STR_PAD_LEFT);
                $p->price = rand(1000, 50000);
                if (Schema::hasColumn('products', 'status')) $p->status = 'active';
                $this->persistDemoProduct($p, $categoryIds, $brandIds, $placeholder);
            }
        }

        /* =========================
         * 4) Articles (รองรับทั้ง body หรือ content)
         * ========================= */
        if (Schema::hasTable('articles')) {
            $hasArticleTitle       = Schema::hasColumn('articles', 'title');
            $hasArticleSlug        = Schema::hasColumn('articles', 'slug');
            $hasArticleBody        = Schema::hasColumn('articles', 'body');
            $hasArticleContent     = Schema::hasColumn('articles', 'content');    // บางโปรเจกต์ใช้ชื่อนี้
            $hasArticleSummary     = Schema::hasColumn('articles', 'summary');
            $hasArticleCover       = Schema::hasColumn('articles', 'cover_image');
            $hasArticleStatus      = Schema::hasColumn('articles', 'status');
            $hasArticlePublishedAt = Schema::hasColumn('articles', 'published_at');
            $hasArticleUserId      = Schema::hasColumn('articles', 'user_id');

            $contentColumn = $hasArticleBody ? 'body' : ($hasArticleContent ? 'content' : null);

            // owner ของบทความ -> admin
            $adminId = DB::table('users')->where('email', 'admin@example.com')->value('id');

            $examples = [
                [
                    'title' => 'How to choose the right GPU for AI workloads',
                    'text'  => 'In this article, we discuss VRAM, CUDA cores, and throughput considerations for training vs inference...',
                ],
                [
                    'title' => 'Building a balanced PC for video editing',
                    'text'  => 'A balanced system avoids bottlenecks. We compare CPU/GPU pairs, storage choices (NVMe vs SATA), and RAM sizing...',
                ],
                [
                    'title' => 'Thermal tips: keeping your build cool',
                    'text'  => 'Airflow planning, case fan placement, positive vs negative pressure, and repasting schedules...',
                ],
            ];

            foreach ($examples as $i => $ex) {
                $keys = $hasArticleSlug
                    ? ['slug' => Str::slug($ex['title'])]
                    : ($hasArticleTitle ? ['title' => $ex['title']] : ['id' => $i + 1]);

                $payload = [];
                if ($hasArticleTitle) $payload['title'] = $ex['title'];
                if ($hasArticleSlug)  $payload['slug']  = Str::slug($ex['title']);
                if ($contentColumn)   $payload[$contentColumn] = $ex['text'];
                if ($hasArticleSummary)     $payload['summary']     = 'Demo summary: '.$ex['title'];
                if ($hasArticleStatus)      $payload['status']      = 'published';
                if ($hasArticlePublishedAt) $payload['published_at'] = now()->subDays(10 - $i);
                if ($hasArticleUserId && $adminId) $payload['user_id'] = $adminId;

                $article = Article::updateOrCreate($keys, $payload);

                if ($hasArticleCover && is_file($placeholder) && empty($article->cover_image)) {
                    $coverPath = 'articles/'.Str::uuid().'.jpg';
                    Storage::disk('public')->put($coverPath, file_get_contents($placeholder));
                    $article->update(['cover_image' => $coverPath]);
                }
            }
        }
    }

    /**
     * บันทึกสินค้า demo 1 รายการ + stock + cover + attributes
     */
    private function persistDemoProduct(Product $p, array $categoryIds, array $brandIds, string $placeholder): void
    {
        if (!empty($categoryIds)) $p->category_id = $categoryIds[array_rand($categoryIds)];
        if (!empty($brandIds))    $p->brand_id    = $brandIds[array_rand($brandIds)];

        $p->save();

        if (Schema::hasTable('stocks')) {
            Stock::updateOrCreate(['product_id' => $p->id], ['qty' => rand(0, 50)]);
        }

        if (is_file($placeholder)) {
            $path = 'products/'.Str::uuid().'.jpg';
            Storage::disk('public')->put($path, file_get_contents($placeholder));
            if (Schema::hasColumn('products', 'cover_image')) {
                $p->update(['cover_image' => $path]);
            }
        }

        if (method_exists($p, 'attributes')) {
            $p->attributes()->createMany([
                ['name' => 'Brand',  'value' => optional($p->brand)->name, 'sort_order' => 1],
                ['name' => 'Series', 'value' => 'Demo Series',             'sort_order' => 2],
            ]);
        }
    }
}
