<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => 'Product ' . $this->faker->randomDigit(),
            'serie' => $this->faker->randomDigit(),
            'length' => $this->faker->randomDigit() . 'cm',
            'height' => $this->faker->randomDigit() . 'cm',
        ];
    }
}
