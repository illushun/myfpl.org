<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Player;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fpl_id' => $this->faker->randomNumber(4, false),
            'code' => $this->faker->randomNumber(3, false),
            'photo' => $this->faker->name(),
            'first_name' => $this->faker->name(),
            'second_name' => $this->faker->name(),
            'web_name' => $this->faker->name(),
            'squad_number' => $this->faker->randomNumber(2, false),
            'status' => $this->faker->randomElement(['a', 'd', 'u']),
            'team_id' => $this->faker->numberBetween(1, 20),
            'player_type' => $this->faker->numberBetween(1, 4),
            'special' => $this->faker->boolean() ? 'true' : 'false',
        ];
    }
}
