<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'       => fake()->randomElement([
                'Brand','Series','Socket Type','Cores/Threads',
                'Base Frequency','Max Turbo','L2 Cache','L3 Cache','Warranty'
            ]),
            'value'      => fake()->randomElement([
                'AMD','Intel','5000 Series','AM4','6C/12T','3.6 GHz','4.2 GHz','3 MB','16 MB','3 Years'
            ]),
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }
}
