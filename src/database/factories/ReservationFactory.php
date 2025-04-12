<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'user_id' => null,
            'shop_id' => $this->faker->numberBetween(1,20),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'number' => $this->faker->numberBetween(1,30),
        ];
    }
}
