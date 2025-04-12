<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'name' => $this->faker->company,
            'area_id' => $this->faker->randomElement([1, 2]),
            'category_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'description' => $this->faker->paragraph,
            'image' => 'https://example.com/path/image.jpg',
        ];
    }
}
