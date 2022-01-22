<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // TV
        // $name = 'Android Tivi' . $this->faker->unique()->words($nb = 1, $asText = true) . '4K 55 inch KD-' . $this->faker->numberBetween(1, 15) . 'X80J';
        // $slug = Str::slug($name);
        // return [
        //     'name' => $name,
        //     'slug' => $slug,
        //     'desc' => $this->faker->text(100),
        //     'content' => $this->faker->text(200),
        //     'price' => $this->faker->numberBetween(1, 9999) * 1000,
        //     // 'sale_price' => $this->faker->numberBetween(1, 500) * 1000,
        //     'image' => '1642838497.jpg',
        //     'status' =>  1,
        //     'category_id' => 1,
        //     'brand_id' => $this->faker->numberBetween(1, 4),
        //     'quantity' =>  $this->faker->numberBetween(0, 20),
        //     'featured' => 0,
        // ];

        $name = 'Máy giặt ' .  $this->faker->unique()->words($nb = 5, $asText = true)  . $this->faker->numberBetween(1, 15) . 'kg WW10DSH/SV ';
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'desc' => $this->faker->text(5),
            'content' => $this->faker->text(5),
            'price' => $this->faker->numberBetween(1, 9999) * 1000,
            // 'sale_price' => $this->faker->numberBetween(1, 500) * 1000,
            'image' => '1642842293.jpg',
            'images' => '16428422930.jpg|16428422931.jpg|16428422932.jpg|16428422933.jpg',
            'status' =>  '1',
            'category_id' => 3,
            'brand_id' => $this->faker->numberBetween(2, 4),
            'quantity' =>  $this->faker->numberBetween(0, 20),
            'featured' => '0',
        ];
    }
}
