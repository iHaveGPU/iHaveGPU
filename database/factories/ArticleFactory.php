<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);
        return [
            'title'        => $title,
            'slug'         => Str::slug($title . '-' . fake()->unique()->numerify('###')),
            'excerpt'      => fake()->paragraph(),
            'content'      => collect(fake()->paragraphs(6))->map(fn($p)=>"<p>{$p}</p>")->implode(''),
            'cover_image'  => null, // ใส่ path รูปภายหลังได้
            'author_id'    => 1,
            'published_at' => now()->subDays(rand(0, 90)),
            'is_published' => true,
        ];
    }
}
