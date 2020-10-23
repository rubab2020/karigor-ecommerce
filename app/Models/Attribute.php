<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
	/**
	 * return attribute name
	 *
	 * @return string
	 **/
	public static function name($id)
	{
		$attribute = self::find($id);
		return $attribute ? $attribute->name : null;
	}

}