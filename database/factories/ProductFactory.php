<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /** @var class-string<\Illuminate\Database\Eloquent\Model> */
    protected $model = Product::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'price' => $this->faker->numberBetween(5, 100),
            'photo' => $this->faker->imageUrl(800, 800, '', true, null, true),
        ];
    }
}
