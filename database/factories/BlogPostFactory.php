<?php

namespace Database\Factories;

use App\Enums\Category;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => '<p>'.implode('</p><p>', fake()->paragraphs(4)).'</p>',
            'featured_image' => null,
            'meta_title' => null,
            'meta_description' => fake()->sentence(12),
            'category' => fake()->randomElement(Category::cases())->value,
            'author' => 'GISBA Editorial Team',
        ];
    }
}
