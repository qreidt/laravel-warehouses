<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = User::factory()
			->create([
				'name' => 'Warehouse Administrator',
				'email' => 'administrator@laravel-warehouses.proj'
			]);

		$team = Team::factory()
			->create([
				'name' => 'Warehouse',
				'user_id' => $user->id
			]);

		$warehouses = Warehouse::factory()
			->count(rand(5, 8))
			->create([
				'team_id' => $team->id
			]);

		$products = Product::factory()
			->count(rand(30, 67))
			->create([
				'team_id' => $team->id
			]);

		$warehouses->each(function (Warehouse $warehouse) use ($products) {
			$warehouse->products()->attach($products->pluck('id'), ['quantity' => rand(32, 87)]);
		});
	}
}
