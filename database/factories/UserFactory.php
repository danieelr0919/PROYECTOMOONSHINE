<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Usar helper fake() de Laravel o $this->faker si está disponible
        if (function_exists('fake')) {
            $faker = fake();
        } elseif (property_exists($this, 'faker') && $this->faker !== null) {
            $faker = $this->faker;
        } else {
            // Fallback: crear instancia manualmente
            $faker = \Faker\Factory::create();
        }
        
        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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

    public function empleado(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'empleado',
        ]);
    }

    public function cliente(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'cliente',
        ]);
    }
}
