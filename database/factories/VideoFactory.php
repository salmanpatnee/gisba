<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'path' => 'videos/'.fake()->uuid().'.mp4',
            'mime_type' => 'video/mp4',
            'size' => fake()->numberBetween(1048576, 104857600),
        ];
    }
}
