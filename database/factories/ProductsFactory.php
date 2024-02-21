<?php

namespace Database\Factories;

use App\Models\CategoryLevelOne;
use App\Models\CategoryLevelTwo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{

    public function definition(): array
    {
        return [
            'cat_one_id' => CategoryLevelOne::factory(10)->create()->id,
            'cat_two_id' =>CategoryLevelTwo::factory(10)->create()->id,
            'cat_three_id' => fake()->name(),
            'brand_id' => fake()->name(),
            'title' => fake()->title(),
            'product_code' => fake()->randomDigit(),
            'sku' => fake()->randomNumber(),
            'price' => '500',
            'special_price' => '200',
            'remark' => 'Hot Deals',
            'star' => 10,
            //'image' => fake()->name(),
        ];
    }
}
