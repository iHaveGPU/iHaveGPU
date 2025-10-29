<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class StockFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(), // หรือกำหนดเองตอนเรียก create()
            'qty'        => $this->faker->numberBetween(5, 30),
        ];
    }
}
