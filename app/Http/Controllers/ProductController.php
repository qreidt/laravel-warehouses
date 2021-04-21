<?php

namespace App\Http\Controllers;

use App\Jobs\AttachNewProductToWarehouses;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Inertia\Response
	 * @throws \Exception
	 */
	public function index()
	{
		try {

			$products = Product::query()
				->withSum('warehouse_products', 'quantity')
				->get()
				->map(function (Product $product) {
					$product['total_quantity'] = floatval($product['warehouse_products_sum_quantity']);
					unset($product['warehouse_products_sum_quantity']);
					return $product;
				});

			return Inertia::render('Products/List', [
				'products' => $products
			]);

		} catch (\Exception $exception) {
			Log::error($exception->getMessage(), [
				'Controller' => 'ProductController',
				'Function' => 'index'
			]);

			throw $exception;
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Inertia\Response
	 */
	public function create()
	{
		return Inertia::render('Products/Show', [
			'units' => Product::UNITS
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{

		$data = $request->validate([
			'name' => ['required'],
			'price' => ['required', 'numeric'],
			'unit' => ['required']
		]);

		$data['team_id'] = $request->user()->current_team_id;

		$product = new Product($data);

		$product->save();

		AttachNewProductToWarehouses::dispatch($product);

		return Redirect::route('products.show', $product['id']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Product $product
	 * @return \Inertia\Response
	 */
	public function show(Product $product)
	{
		return Inertia::render('Products/Show', [
			'units' => Product::UNITS,
			'product' => $product
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Product $product
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, Product $product)
	{
		$data = $request->validate([
			'name' => ['required'],
			'price' => ['required', 'numeric'],
			'unit' => ['required']
		]);

		$product->fill($data);

		$product->update();

		return Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Product $product
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Product $product)
	{
		$product->delete();

		return Redirect::back();
	}
}
