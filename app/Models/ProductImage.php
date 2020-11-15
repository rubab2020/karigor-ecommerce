<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	protected $table = 'product_images';

	public static function getImages($pid)
	{
		return Self::where('product_id', $pid)->get();
	}
}