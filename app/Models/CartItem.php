<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    //
    protected $fillable = [
        'product_id',
        'cart_id',
        'qty',
        'vendor_id',
        'base_price',
        'final_price',
        'discount_amount',
        'discount_percent'
    ];

    public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}
}
