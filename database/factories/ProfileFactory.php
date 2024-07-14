<?php

namespace Database\Factories;

use App\Models\C3;
use App\Models\User;
use App\Models\Center;
use App\Models\ServiceTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->title,
            'phone' => $this->faker->phoneNumber,
            'whatsapp_number' => $this->faker->phoneNumber,
            'occupation' => $this->faker->jobTitle,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'marital_status' => $this->faker->randomElement(['single', 'married', 'divorced', 'separated']),
            'address' => $this->faker->address,
            'center_id' => Center::factory(),
            'c3_id' => C3::factory(),
            'service_team_id' => ServiceTeam::factory(),
            'gone_through_growth_track' => $this->faker->boolean,
            'growth_track_year' => $this->faker->year,
        ];
    }
}
