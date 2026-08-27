<?php

namespace Database\Factories;

use App\Models\CriscCategory;
use App\Models\CriscPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CriscPost>
 */
class CriscPostFactory extends Factory
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
            'category_id' => CriscCategory::factory(),
            'author' => 'GISBA Editorial Team',
        ];
    }
}
