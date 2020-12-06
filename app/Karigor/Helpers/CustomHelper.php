<?php

namespace App\Karigor\Helpers;
use Illuminate\Support\Facades\Validator;

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
		$fileName = null;

		if ($image) {
			if (!is_dir($path)) {
				mkdir($path, 0755, true);
			}

			$fileName = time() . uniqid() . '.' . $image->getClientOriginalExtension();
			$imageLink = $path . $fileName;

			$intvImage = \Image::make($image->getRealPath());
			$intvImage->width() > $intvImage->height() ? $width = null : $height = null; // resize ratio on dimention's lowest value 
			$intvImage->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
			})
				->save($imageLink, $imageQuality);
		}

		return $fileName;
	}

	public static function generateSlug($name, $tableName)
	{
		$slug = \Str::slug($name, '-');
		$data = \DB::table($tableName)->where('slug', 'like', '%' . $slug . '%')->latest()->first();
		if ($data) {
			$pos = strrpos($data->slug, '-');
			$number = substr($data->slug, $pos + 1);
			$number = (int) filter_var($number, FILTER_SANITIZE_NUMBER_INT);
			$slug .= '-' . ($number + 1);
		}
		return $slug;
	}

	public function validateInput($data, $rules = [])
	{
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) {
			return response()->json($validator->messages(), 400);
		}
		return null;
	}
}
