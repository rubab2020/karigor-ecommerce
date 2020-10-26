<?php
namespace App\Models;

use App\Http\Middleware\Merchant;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function images(){
		return $this->hasMany('App\Models\ProductImage', 'product_id');
	}

	public function productAttributes(){
		return $this->hasMany('App\Models\ProductAttribute', 'product_id');
	}

	public static function getSalePrice($salePrice, $salePriceFrom, $salePriceTo) {
		$dateToday = Carbon::today()->toDateString();

		if($salePrice == null) 
			return null;

		// date is before start date
		if($salePriceFrom && $salePriceFrom < $dateToday)
			return null;

		// date is before end date
		if($salePriceTo && $dateToday > $salePriceTo)
			return null;

		return $salePrice;
	}
}