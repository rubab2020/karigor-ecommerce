<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	private static $_uploadPath = 'images/uploads/categories/';

	public function scopeParent($query, $parentId)
	{
		$query->where('parent_id', $parentId);
	}

	public static function getUploadPath()
	{
		return static::$_uploadPath;
	}

	/**
	 * return category names
	 *
	 * @return array
	 **/
	public static function names()
	{
		$categories = self::latest()->get();
		foreach ($categories as $key => $value) {
			$categories[$key]['name'] = $value['name'];
			$parentNames = self::parentNames($value['parent_id']);
			if ($parentNames != '') {
				$categories[$key]['name'] .= ' < ' . $parentNames;
			}
		}

		$selectCategories = [];
		foreach ($categories as $value) {
			$selectCategories[$value['id']] = $value['name'];
		}
		$categories = $selectCategories;

		return $categories;
	}

	/**
	 * return parent category name
	 * @param integer $id
	 *
	 * @return string
	 **/
	public static function parentNames($id)
	{
		$names = '';
		while ($id != null) {
			$category = self::find($id);
			if ($category) {
				$names .= $category->name;
				$id = $category->parent_id;
				$names .= $id != null ? ' < ' : '';
			} else {
				$id = null;
			}
		}
		return $names;
	}

	public static function getPhotoUrl($image)
	{
		$base = \URL::to('/');
		return $base . '/' . static::$_uploadPath . $image;
	}

	public static function getParentChildCategories()
	{
		$categories = [];
		$parents = self::where('parent_id', null)->get();
		foreach ($parents as $key => $parent) {
			$childrens = self::where('parent_id', $parent->id)->get();
			$categories[$key] = $parent;
			$categories[$key]['sub_categories'] = $childrens;
		}
		return $categories;
	}

	public static function getCategoryIdBySlug($slug)
	{
		$category = self::where('slug', $slug)->select('id')->first();
		if ($category)
			return $category->id;
		return null;
	}
}
