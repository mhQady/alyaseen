<?php

namespace Database\Factories;

use App\Models\Category;
use App\Enums\Product\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {

        return [
            "name" => [
                'ar' => fake('ar_SA')->name,
                'en' => fake('en_US')->name,
            ],
            "description" => [
                'ar' => fake('ar_SA')->realText(),
                'en' => fake('en_US')->realText(),
            ],
            'slug' => fake()->slug(),
            'status' => StatusEnum::random()->value,
            'price' => fake()->randomFloat(2, 0, 1000),
            'sku' => fake()->ean8(),
            'current_stock' => fake()->numberBetween(0, 10),
            'min_purchase_qty' => fake()->numberBetween(1, 10),
            'max_purchase_qty' => fake()->numberBetween(0, 1000),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
