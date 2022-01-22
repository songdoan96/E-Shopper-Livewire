<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HomeSliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->words($nb = 7, $asText = true),
            'sub_title' => $this->faker->text(15),
            'description' => $this->faker->text(30),
            'price' => $this->faker->numberBetween(1, 9999) * 1000,
            'image' => 'digital_1.jpg',
            'link' => 'http://127.0.0.1:8000/cart',
            'status' => '1'
        ];
    }
}
