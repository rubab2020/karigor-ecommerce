<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Laravelista\Comments\Commentable;

class Blog extends Model
{
    private static $_uploadPath = 'images/uploads/blogs/';

    public static function getUploadPath()
		{
			return static::$_uploadPath;
		}
}