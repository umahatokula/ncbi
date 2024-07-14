<?php

namespace Database\Factories;

use App\Models\Set;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => Str::slug($this->faker->words(3, true)),
            'set_id' => Set::factory(),
            'number_of_attempts' => $this->faker->numberBetween(1, 5),
            'duration_minutes' => $this->faker->numberBetween(30, 180), // Duration between 30 minutes and 3 hours
            'validity_start_time' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'validity_end_time' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }
}
