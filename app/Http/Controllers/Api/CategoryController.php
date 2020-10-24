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

    function __construct(CategoriesTransformer $categoriesTransformer){
        $this->categoriesTransformer = $categoriesTransformer;
    }

    public function getCategories()
    {
        $parentCategories = Category::where('parent_id', null)->get();
        foreach($parentCategories as $key => $category) {
            $subCategories = Category::parent($category->id)->get();
            $parentCategories[$key]['sub_categories'] = $subCategories;
        }

        return $this->respond([
            'categories' => $this->categoriesTransformer->transformCollection($parentCategories->toArray())
        ]);
	}
}