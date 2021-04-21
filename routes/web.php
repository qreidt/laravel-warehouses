<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return Inertia::render('Welcome', [
		'canLogin' => Route::has('login'),
		'userCount' => \App\Models\User::query()->count(),
		'teamCount' => \App\Models\Team::query()->count(),
		'warehouseCount' => \App\Models\Warehouse::query()->count(),
		'productCount' => \App\Models\Product::query()->count()
	]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

	Route::get('/dashboard', function () {
		return Inertia::render('Dashboard');
	})->name('dashboard');

	Route::resource('warehouses', Controllers\WarehouseController::class)->except(['edit']);

	Route::resource('products', Controllers\ProductController::class)->except(['edit']);
});
