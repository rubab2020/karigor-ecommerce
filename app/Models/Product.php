<?php
namespace App\Models;

use App\Http\Middleware\Merchant;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Karigor\Helpers\EncodeHelper;
use BinaryCats\Sku\HasSku;

class Product extends Model
{
	use SoftDeletes;
	use HasSku;
  	protected $dates = ['deleted_at'];

	private static $_uploadPath = 'images/uploads/products/';

  	public function images(){
		return $this->hasMany('App\Models\ProductImage', 'product_id');
	}

	public function categories(){
		return $this->hasMany('App\Models\ProductCategory', 'product_id');
	}

	public function attributes(){
		return $this->hasMany('App\Models\ProductAttribute', 'product_id');
	}

	public function tags(){
		return $this->hasMany('App\Models\ProductTag', 'product_id');
	}

	public function upSells(){
		return $this->hasMany('App\Models\ProductUpSell', 'product_id');
	}

	public function crossSells(){
		return $this->hasMany('App\Models\ProductCrossSell', 'product_id');
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

	public static function getPhotoPath($pid)
	{
		$encodeHelper = new EncodeHelper();
      	$base = \URL::to('/');
      	return $base 
      		. '/' 
      		. static::$_uploadPath 
      		. $encodeHelper->encodeData($pid)
      		. '/';
	}

	public static function getPhotoUrl($image, $pid)
	{
      	$encodeHelper = new EncodeHelper();
      	$base = \URL::to('/');
      	return $base 
      		. '/' 
      		. static::$_uploadPath 
      		. $encodeHelper->encodeData($pid) 
      		. '/'
      		. $image;
    }

    public static function getLastDataId()
    {
    	$data = Product::select('id')->orderBy('id', 'desc')->first();	
    	if($data== null) 
    		return 1;
		return $data->id;
    }
}