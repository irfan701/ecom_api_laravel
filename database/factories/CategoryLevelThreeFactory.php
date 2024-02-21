<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryLevelThreeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => Str::slug('name')
        ];
    }
}
