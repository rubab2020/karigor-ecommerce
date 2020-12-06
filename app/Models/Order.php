<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //


	public function cart()
	{
		return $this->belongsTo('App\Models\Cart', 'cart_id');
    }
    
    public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function deliveryAddress()
	{
		return $this->hasOne('App\Models\OrderDeliveryAddress', 'order_id');
	}
}
