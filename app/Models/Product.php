<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public const UNITS = [
    	'UNIT', 'KG', 'L'
	];

    protected $fillable = [
    	'team_id', 'name', 'price', 'unit'
	];

    protected $casts = [
    	'price' => 'float'
	];

	public function team () {
		return $this->belongsTo(Team::class);
	}

	public function warehouse_products () {
		return $this->hasMany(WarehouseProduct::class);
	}

	public function warehouses () {
		return $this->belongsToMany(Product::class, 'warehouse_product');
	}
}
