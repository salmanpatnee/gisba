<?php

namespace Database\Factories;

use App\Models\CriscCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CriscCategory>
 */
class CriscCategoryFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
        ];
    }
}
