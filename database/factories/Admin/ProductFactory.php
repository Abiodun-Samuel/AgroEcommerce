<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Product>
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
            'user_id' => '97dd972a-fcff-4cc1-9ede-f33b0eee28e8',
            'category_id' => '97db78ba-acc2-40fc-961b-880028b7d297',
            'subcategory_id' => '97db7b65-1c33-42ca-9150-8c6fbd9dcc17',
            'title' => $this->faker->unique()->sentence(),
            'sub_title' => $this->faker->unique()->sentence(),
            'slug' => $this->faker->unique()->sentence(),
            'images' => json_encode([$this->faker->text()]),
            'description' => $this->faker->text(),
            'ingredient' => $this->faker->text(),
            'pack_size' => $this->faker->unique()->sentence(),
            'company_name' => $this->faker->unique()->sentence(),
            'price' => 502.23,
            'discount_price' => 459.56,
            'stock' => $this->faker->randomDigitNot(5),
            'rating' => 56,
            'numReviews' => 100
        ];
    }
}