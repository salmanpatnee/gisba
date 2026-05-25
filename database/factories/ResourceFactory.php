<?php

namespace Database\Factories;

use App\Enums\ResourceType;
use App\Models\Chapter;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<resource>
 */
class ResourceFactory extends Factory
{
    public function definition(): array
    {
        $chapter = Chapter::factory()->create();

        return [
            'file_name' => fake()->word().'.mp4',
            'file_path' => 'chapters/resources/'.fake()->uuid().'.mp4',
            'file_type' => 'video/mp4',
            'resource_type' => ResourceType::Tutorial,
            'resourceable_type' => Chapter::class,
            'resourceable_id' => $chapter->id,
        ];
    }

    public function quiz(): static
    {
        return $this->state(['resource_type' => ResourceType::Quizzes]);
    }

    public function forChapter(Chapter $chapter): static
    {
        return $this->state([
            'resourceable_type' => Chapter::class,
            'resourceable_id' => $chapter->id,
        ]);
    }
}
