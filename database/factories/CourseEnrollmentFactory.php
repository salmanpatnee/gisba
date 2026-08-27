<?php

namespace Database\Factories;

use App\Models\CourseEnrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CourseEnrollment>
 */
class CourseEnrollmentFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'course' => 'crisc',
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'amount' => 9.99,
            'currency' => 'USD',
            'paypal_order_id' => fake()->unique()->uuid(),
            'status' => 'completed',
        ];
    }
}
