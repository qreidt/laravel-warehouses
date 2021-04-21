<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AttachNewProductToWarehouses implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private Product $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return int
     */
    public function handle()
    {
        $warehouses = Warehouse::query()
			->where('team_id', '=', $this->product->team_id)
			->get();

        $warehouses->each(function (Warehouse $warehouse) {
        	$warehouse->products()->attach($this->product->id, ['quantity' => 0]);
		});

        return $warehouses->count();
    }
}
