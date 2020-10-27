<?php

namespace App\Karigor\Transformers;

use App\Karigor\Transformers\Transformer;
use App\Karigor\Helpers\EncodeHelper;
use App\Models\BlogCategory;

class BlogCategoriesTransformer extends Transformer
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
    public function transform($blogCategory)
    {
        return [
            'id' => $this->encodeHelper->encodeData($blogCategory['id']),
            'name' => $blogCategory['name'],
            'slug' => $blogCategory['slug'],
        ];
    }
}
