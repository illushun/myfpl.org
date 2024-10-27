<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'short_name' => $this->faker->randomLetter(),
            'team_division' => null,
            'win' => $this->faker->numberBetween(0, 30),
            'draw' => $this->faker->numberBetween(0, 30),
            'loss' => $this->faker->numberBetween(0, 30),
            'played' => $this->faker->numberBetween(0, 38),
            'position' => $this->faker->numberBetween(1, 20),
            'points' => $this->faker->numberBetween(0, 100),
            'form' => $this->faker->randomFloat(2, 0, 10),
            'strength' => $this->faker->numberBetween(0, 100),
            'code' => $this->faker->numberBetween(1, 999),
            'pulse_id' => $this->faker->numberBetween(1, 999),
            'unavailable' => $this->faker->boolean() ? 'true' : 'false',
        ];
    }
}
