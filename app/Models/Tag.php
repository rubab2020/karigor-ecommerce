<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
	 * return tag name
	 *
	 * @return string
	 **/
	public static function name($id)
	{
		$tag = self::find($id);
		return $tag ? $tag->name : null;
	}

}