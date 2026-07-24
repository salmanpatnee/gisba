<?php

namespace Database\Factories;

use App\Enums\ActivityType;
use App\Models\SessionActivity;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SessionActivity>
 */
class SessionActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_session_id' => UserSession::factory(),
            'user_id' => User::factory(),
            'type' => ActivityType::PageVisit,
            'route_name' => 'members.chapters.index',
            'url' => 'members/chapters',
            'method' => 'GET',
            'label' => 'Chapters',
            'module' => 'Members',
            'meta' => null,
            'occurred_at' => fake()->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
