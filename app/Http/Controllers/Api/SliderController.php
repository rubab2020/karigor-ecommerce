<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Karigor\Transformers\SlidersTransformer;

class SliderController extends ApiController
{
    /**
     * @var array
     **/
    private $slidersTransformer;

    function __construct(SlidersTransformer $slidersTransformer)
    {
        $this->slidersTransformer = $slidersTransformer;
    }

    public function getSliders()
    {
        $sliders = Slider::get();

        return $this->respond([
            'sliders' => $this->slidersTransformer->transformCollection($sliders->toArray())
        ]);
    }
}
