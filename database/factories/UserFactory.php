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
    public function definition()
    {
        return [
            'name' => fake()->name(),
<<<<<<< HEAD
            'email' => fake()->unique()->safeEmail(),
=======
            'email' => fake()->safeEmail(),
>>>>>>> 9989a496f1dd5c140f4fd5f06aa63772036475a3
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
<<<<<<< HEAD
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
=======
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
>>>>>>> 9989a496f1dd5c140f4fd5f06aa63772036475a3
    }
}
