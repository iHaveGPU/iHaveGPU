<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->bothify('##?? RYZEN/GPU/SSD ###');
        return [
            'name'        => $name,
            'sku'         => strtoupper('SKU-'.fake()->unique()->numerify('#####')),
            'price'       => fake()->randomFloat(2, 990, 39990),
            'status'      => 'active',
            'brand_id'    => Brand::inRandomOrder()->value('id') ?? Brand::factory(),
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'cover_image' => null, // จะใส่ใน Seeder
        ];
    }
}
