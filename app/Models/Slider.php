<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    private static $_uploadPath = 'uploads/sliders/';

    public static function getPhotoUrl($image)
    {
        $base = \URL::to('/');
        return $base . '/' . static::$_uploadPath . $image;
    }
}
