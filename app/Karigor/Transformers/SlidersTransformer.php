<?php

namespace App\Karigor\Transformers;

use App\Karigor\Transformers\Transformer;
use App\Karigor\Helpers\EncodeHelper;
use App\Models\Slider;

class SlidersTransformer extends Transformer
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
    public function transform($slider)
    {
        return [
            'id' => $this->encodeHelper->encodeData($slider['id']),
            'image_bg' => Slider::getPhotoUrl($slider['image_bg']),
            'image_sm' => Slider::getPhotoUrl($slider['image_sm']),
            'link' => $slider['link']
        ];
    }
}
