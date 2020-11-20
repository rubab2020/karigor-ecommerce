<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Karigor\Transformers\CategoriesTransformer;

class CategoryController extends ApiController
{
    /**
     * @var array
     **/
    private $categoriesTransformer;

    function __construct(CategoriesTransformer $categoriesTransformer)
    {
        $this->categoriesTransformer = $categoriesTransformer;
    }

    /**
     * get all categories with nested children
     */
    public function getCategories()
    {
        $parentCategories = Category::where('parent_id', null)->get();
        foreach ($parentCategories as $key => $category) {
            $subCategories = Category::parent($category->id)->get();
            $parentCategories[$key]['sub_categories'] = $subCategories;
        }

        $result = $parentCategories->map(function ($category, $key) {
            $item = $this->transformCategory($category);
            return $item;
        });

        return $result;

        // return $this->respond([
        //     'categories' => $this->categoriesTransformer->transformCollection($parentCategories->toArray())
        // ]);
    }

    /**
     * get a single category
     */
    public function getCategory(Request $request)
    {

        $slug = $request->slug;
        $category = Category::where('slug', $slug)->first();
        $category['sub_categories'] = Category::parent($category->id)->get();
        $item = $this->transformCategory($category);
        return $item;
    }

    public function transformCategory($category)
    {
        $category['image_bg'] = Category::getPhotoUrl($category['image_bg']);
        $category['image_sm'] = Category::getPhotoUrl($category['image_sm']);
        $category['sub_categories'] = $category['sub_categories']->map(function ($subCategory, $index) {
            $subCategory['image_bg'] = $subCategory::getPhotoUrl($subCategory['image_bg']);
            $subCategory['image_sm'] = $subCategory::getPhotoUrl($subCategory['image_sm']);
            return $subCategory;
        });
        return $category;
    }
}
