<?php
namespace App\Karigor\Helpers;

class CustomHelper
{
	/**
	 * save image to directory
	 * @param file $image
	 * @param string $path
	 * @param integer witdh
	 * @param integer height
	 *
	 * @return string
	 **/
	public static function saveImage($image, $path, $width,  $height)
	{
		$imageLink = '';
		$imageQuality = 75;

        if($image){
            if(!is_dir($path)){
				mkdir($path, 0755, true);
			}

            $fileName = time().uniqid().'.'.$image->getClientOriginalExtension();
            $imageLink = $path.$fileName;
            
            $intvImage = \Image::make($image->getRealPath());
            $intvImage->width() > $intvImage->height() ? $width=null : $height=null; // resize ratio on dimention's lowest value 
            $intvImage->resize($width, $height, function($constraint){
                $constraint->aspectRatio();
            })
			->save($imageLink, $imageQuality); 
        }

        return $fileName;
	}

}