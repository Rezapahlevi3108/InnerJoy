<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$reELpzP0oSOwbnZxzgs07uqMS50QPUs5GPnEcRVe940vmne.n.fHm',
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'active' => true,
            'google_id' => null,
        ];
    }
}
