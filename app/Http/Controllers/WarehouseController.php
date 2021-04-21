<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WarehouseController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Inertia\Response
	 * @throws \Exception
	 */
    public function index(Request $request)
    {
		try {

			$warehouses = Warehouse::query()
				->where('team_id', $request->user()->current_team_id)
				->withCount('products')
				->get();

			return Inertia::render('Warehouses/List', [
				'warehouses' => $warehouses
			]);

		} catch (\Exception $exception) {
			Log::error($exception->getMessage(), [
				'Controller' => 'WareHouseController',
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
		return Inertia::render('Warehouses/Show');
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
			'is_active' => ['required', 'boolean'],
			'zipcode' => ['required'],
			'state' => ['required'],
			'city' => ['required'],
			'street' => ['required'],
			'number' => ['required', 'integer'],
			'complement' => ['nullable']
		]);

    	$warehouse = new Warehouse([
    		'team_id' => $request->user()->current_team_id,
    		'name' => $data['name'],
    		'is_active' => $data['is_active'],
    		'zipcode' => $data['zipcode'],
    		'address' => [
    			'state' => $data['state'],
    			'city' => $data['city'],
    			'street' => $data['street'],
    			'number' => $data['number'],
				'complement' => $data['complement']
			]
		]);

    	$warehouse->save();

        return Redirect::route('warehouses.show', $warehouse['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param Warehouse $warehouse
     * @return \Inertia\Response
	 */
    public function show(Warehouse $warehouse)
    {
    	foreach ($warehouse['address'] as $key => $address_item) {
    		$warehouse[$key] = $address_item;
		}

		return Inertia::render('Warehouses/Show', [
			'warehouse' => $warehouse
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Warehouse $warehouse
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Warehouse $warehouse)
    {
		$data = $request->validate([
			'name' => ['required'],
			'is_active' => ['required', 'boolean'],
			'zipcode' => ['required'],
			'state' => ['required'],
			'city' => ['required'],
			'street' => ['required'],
			'number' => ['required', 'integer'],
			'complement' => ['nullable']
		]);

		$warehouse->fill([
			'name' => $data['name'],
			'is_active' => $data['is_active'],
			'zipcode' => $data['zipcode'],
			'address' => [
				'state' => $data['state'],
				'city' => $data['city'],
				'street' => $data['street'],
				'number' => $data['number'],
				'complement' => $data['complement']
			]
		]);

		$warehouse->update();

		return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Warehouse $warehouse
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return Redirect::back();
    }
}
