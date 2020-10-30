<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Karigor\Transformers\BlogCategoriesTransformer;

class BlogCategoryController extends ApiController
{
    /**
     * @var array
     **/
    private $blogCategoriesTransformer;

    function __construct(BlogCategoriesTransformer $blogCategoriesTransformer)
    {
        $this->blogCategoriesTransformer = $blogCategoriesTransformer;
    }

    public function getBlogCategories()
    {
        $blogCategories = BlogCategory::get();

        return $this->respond([
            'blogCategories' => $this->blogCategoriesTransformer->transformCollection($blogCategories->toArray())
        ]);
    }
}
