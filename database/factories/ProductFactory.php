<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 4),
            'image' => 'https://dummyimage.com/300x300/fff/aaa',
            'name' => $this->faker->word(),
            'stock' => $this->faker->randomNumber(3, false),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomNumber(5, false)
        ];
    }
}
