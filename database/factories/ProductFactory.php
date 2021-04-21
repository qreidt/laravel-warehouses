<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Team;
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
            'team_id' => Team::factory(),
			'name' => $this->faker->word(),
			'unit' => $this->faker->randomElement(Product::UNITS),
			'price' => $this->faker->randomFloat(3, 50, 399)
        ];
    }
}
