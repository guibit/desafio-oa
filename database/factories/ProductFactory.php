<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description'=>$this->faker->text(),
            'category' => $this->faker->name(),
            'price'=>$this->faker->numberBetween(1,1000),
            'amount'=>$this->faker->numberBetween(1,20),
            'picture'=>$this->faker->address,
            'user_id'=>1,
        ];
    }
}
