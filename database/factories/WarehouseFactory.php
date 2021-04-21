<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warehouse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'team_id' => Team::factory(),
            'name' => $this->faker->company,
            'is_active' => $this->faker->boolean(90),
            'zipcode' => $this->faker->randomNumber(5),
            'address' => [
            	'state' => $this->faker->state,
            	'city' => $this->faker->city,
            	'street' => $this->faker->streetName,
            	'number' => $this->faker->randomNumber(3),
            	'complement' => '',
			]
        ];
    }
}
