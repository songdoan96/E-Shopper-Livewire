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
        /*
            $table->id();
            $table->text('name')->unique();
            $table->text('slug')->unique();
            $table->text('desc')->nullable();
            $table->text('content')->nullable();
            $table->decimal('price');
            $table->decimal('sale_price')->nullable();
            $table->string('image');
            $table->enum('status', ["0", "1"])->default("0");
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
      
        */
        $name = $this->faker->unique()->words($nb = 7, $asText = true);
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'desc' => $this->faker->text(100),
            'content' => $this->faker->text(200),
            'price' => $this->faker->numberBetween(1, 9999) * 1000,
            // 'sale_price' => $this->faker->numberBetween(1, 500) * 1000,
            'image' => 'digital_' . $this->faker->unique()->numberBetween(1, 67) . '.jpg',
            'status' =>  (string)$this->faker->numberBetween(0, 1),
            'category_id' => $this->faker->numberBetween(1, 7),
            'brand_id' => $this->faker->numberBetween(1, 15),
            'quantity' =>  $this->faker->numberBetween(0, 20),
            'featured' => (string)$this->faker->numberBetween(0, 1),
        ];
    }
}
