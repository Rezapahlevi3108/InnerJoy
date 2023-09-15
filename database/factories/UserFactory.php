<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Nadia Larasati',
            'email' => 'nadia@gmail.com',
            'password' => '$2y$10$zTzAnkp9txSM9EwhB3OtkuTdgXkWs9s4JqGH7NB6f2YVO5UQa3/AS',
            'remember_token' => Str::random(10),
            'role' => 'user',
            'active' => true,
            'google_id' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
