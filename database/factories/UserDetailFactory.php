<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id'           => User::factory(),
            'address'           => $this->faker->address(),
            'city'              => $this->faker->city(),
            'state'             => $this->faker->state(),
            'country'           => $this->faker->country(),
            'zip_code'          => $this->faker->postcode(),
            'about'             => $this->faker->paragraph(),
            'dob'               => $this->faker->date(),

        ];
    }
}
