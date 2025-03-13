<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
     
        return [
            
        'name'=> $this->faker->name(),
        'description'=>$this->faker->paragraph(),
        'category_id'=> 1,
        'price'=> $this->faker->randomNumber(2),
        'amount'=>$this->faker->randomNumber(1),
        'image'=> fake()->imageUrl,
        'company_id'=> 1,

        ];
    }
}
