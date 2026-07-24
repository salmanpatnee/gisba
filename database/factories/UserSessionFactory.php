<?php

namespace Database\Factories;

use App\Enums\SessionStatus;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<UserSession>
 */
class UserSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loginAt = fake()->dateTimeBetween('-1 week', 'now');

        return [
            'user_id' => User::factory(),
            'session_token' => (string) Str::uuid(),
            'login_at' => $loginAt,
            'logout_at' => null,
            'last_activity_at' => $loginAt,
            'duration_seconds' => null,
            'status' => SessionStatus::Active,
            'login_method' => 'password',
            'ip_address' => fake()->ipv4(),
            'browser' => fake()->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']),
            'platform' => fake()->randomElement(['Windows', 'macOS', 'iOS', 'Android', 'Linux']),
            'device_type' => fake()->randomElement(['Desktop', 'Mobile', 'Tablet']),
            'user_agent' => fake()->userAgent(),
        ];
    }

    public function ended(): static
    {
        return $this->state(function (array $attributes) {
            $loginAt = $attributes['login_at'];
            $logoutAt = fake()->dateTimeBetween($loginAt, (clone $loginAt)->modify('+2 hours'));

            return [
                'logout_at' => $logoutAt,
                'last_activity_at' => $logoutAt,
                'duration_seconds' => $logoutAt->getTimestamp() - $loginAt->getTimestamp(),
                'status' => SessionStatus::Ended,
            ];
        });
    }
}
