<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'user_type' => $this->faker->randomElement([0,1]),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
            'token'  => Str::random(4),
        ];
    }

    public function rider()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 1,
            ];
        });
    }

    public function customer()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 0,
            ];
        });
    }
}
