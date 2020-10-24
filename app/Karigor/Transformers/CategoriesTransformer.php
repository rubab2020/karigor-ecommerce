<?php
namespace App\Karigor\Transformers;

use App\Karigor\Transformers\Transformer;
use App\Karigor\Helpers\EncodeHelper;
use App\Models\Category;

class CategoriesTransformer extends Transformer
{
	/**
     * @var App\Helpers\EncodeHelper
     **/
    private $encodeHelper;

    function __construct(EncodeHelper $encodeHelper)
    {
        $this->encodeHelper = $encodeHelper;
    }

	/**
     * transform a object for mapping between api parameters and database columns
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transform($category)
    {
        return [
            'id' => $this->encodeHelper->encodeData($category['id']),
            'name' => $category['name'],
            'slug' => $category['slug'],
            'image_bg' => Category::getPhotoUrl($category['image_bg']),
            'image_sm' => Category::getPhotoUrl($category['image_sm']),
            'icon' => Category::getPhotoUrl($category['icon']),
            'description' => $category['description'],
            'sub_categories' => $this->transformSubCategories($category['sub_categories'])
        ];
    }

    /**
     * transform collection of sub categories
     *
     * @param $items
     * @return array
     **/
    public function transformSubCategories($categories)
    {
        return array_map([$this, 'transformSubCategory'], is_array($categories) ? $categories : $categories->toArray());
    }

    /**
     * transform sub category
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transformSubCategory($category)
    {
        return [
            'id' => $this->encodeHelper->encodeData($category['id']),
            'name' => $category['name'],
            'slug' => $category['slug'],
            'image_bg' => Category::getPhotoUrl($category['image_bg']),
            'image_sm' => Category::getPhotoUrl($category['image_sm']),
            'icon' => Category::getPhotoUrl($category['icon']),
            'description' => $category['description']
        ];
    }
}