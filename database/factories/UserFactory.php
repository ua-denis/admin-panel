<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar' => $this->faker->imageUrl(100, 100, 'people'),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): Factory|UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_admin' => true,
            ];
        });
    }

    public function nonAdmin(): Factory|UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_admin' => false,
            ];
        });
    }
}
