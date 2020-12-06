<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Karigor\Transformers\ProductsTransformer;

class HomeController extends Controller
{
    //
    private $productsTransformer;

    function __construct(
        ProductsTransformer $productsTransformer
    ) {
        $this->productsTransformer = $productsTransformer;
    }

    public function getHome(Request $request){
        $products = Product::limit(8)->get();
        $data = [
            [   'type' => 'Product',
                'title' => 'Trending Products',
                'contents' => $this->productsTransformer->transformCollection($products->toArray())
            ],
            [   'type' => 'Product',
                'title' => 'Most Viewed Products',
                'contents' => $this->productsTransformer->transformCollection($products->toArray())
            ],
            [   'type' => 'Product',
                'title' => 'Most Sold Products',
                'contents' => $this->productsTransformer->transformCollection($products->toArray())
            ]

            ];
        return $data;
    }
}
