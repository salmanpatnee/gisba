<?php

namespace Database\Factories;

use App\Models\PmpCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PmpCategory>
 */
class PmpCategoryFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
        ];
    }
}
