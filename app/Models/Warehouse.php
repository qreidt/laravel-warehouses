<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'team_id', 'name', 'is_active', 'zipcode', 'address'
	];

    protected $casts = [
    	'is_active' => 'boolean',
		'address' => 'array'
	];

    public function team () {
    	return $this->belongsTo(Team::class);
	}

	public function products () {
    	return $this->belongsToMany(Product::class, 'warehouse_product');
	}
}
