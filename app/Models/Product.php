<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public const UNITIES = [
    	'UNIT' => 1,
		'KG' => 2,
		'L' => 3
	];

    protected $fillable = [
    	'team_id', 'name', 'price', 'unity'
	];

	public function team () {
		return $this->belongsTo(Team::class);
	}

	public function products () {
		return $this->belongsToMany(Product::class, 'warehouse_product');
	}
}
