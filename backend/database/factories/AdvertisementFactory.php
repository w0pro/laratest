<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'title' => Str::random(20),
            'description' => Str::random(100),
            'price'=>round(0.01 + mt_rand() / mt_getrandmax() * (99999.99 - 0.01), 2)

        ];
    }
}
