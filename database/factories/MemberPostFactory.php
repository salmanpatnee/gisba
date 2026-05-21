<?php

namespace Database\Factories;

use App\Models\MemberPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<MemberPost>
 */
class MemberPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => '<p>'.$this->faker->paragraphs(4, true).'</p>',
            'featured_image' => null,
            'meta_title' => null,
            'meta_description' => null,
            'author' => 'GISBA Editorial Team',
        ];
    }
}
