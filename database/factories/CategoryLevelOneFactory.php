<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryLevelOneFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'slug' =>  fake()->title(),
        ];
    }
}
