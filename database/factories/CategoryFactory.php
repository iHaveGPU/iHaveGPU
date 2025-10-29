<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'CPU','Mainboard','GPU','RAM','SSD','HDD','PSU','Case','Notebook','Monitor'
        ]);

        $data = [
            'name' => $name,
            'slug' => Str::slug($name),
        ];

        // เติมเฉพาะถ้ามีคอลัมน์จริงใน DB
        if (Schema::hasColumn('categories','status'))     $data['status']     = 'active';
        if (Schema::hasColumn('categories','sort_order')) $data['sort_order'] = fake()->numberBetween(0,999);

        return $data;
    }
}
