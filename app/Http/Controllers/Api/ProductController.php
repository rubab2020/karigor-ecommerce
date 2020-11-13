<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Karigor\Helpers\EncodeHelper;
use App\Karigor\Transformers\ProductsTransformer;
use App\Karigor\Transformers\ProductDetailsTransformer;

class ProductController extends ApiController
{
    private $productsTransformer;
    private $productDetailsTransformer;
    private $encodeHelper;

    function __construct(
        ProductsTransformer $productsTransformer, 
        ProductDetailsTransformer $productDetailsTransformer,
        EncodeHelper $encodeHelper
    ){
        $this->productsTransformer = $productsTransformer;
        $this->productDetailsTransformer = $productDetailsTransformer;
        $this->encodeHelper = $encodeHelper;
    }

    public function getProducts()
    {
        $products = Products::get();

        return $this->respond([
            'products' => $this->productsTransformer->transformCollection($products->toArray())
        ]);
	}

    public function getProductDetails($pid)
    {
        $decodedPid = $this->encodeHelper->decodeData($pid);

        $product = Product::with(['images', 'categories', 'tags', 'attributes', 'up_sells', 'cross_sells'])->find($decodedPid);
        
        if(!$product)
            return $this->respondNotFound('Product Not Found.');
        
        return $this->respond($this->productDetailsTransformer->transform($product));
    }
}