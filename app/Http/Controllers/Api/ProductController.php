<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Karigor\Helpers\EncodeHelper;
use App\Karigor\Transformers\ProductsTransformer;
use App\Karigor\Transformers\ProductDetailsTransformer;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Vendor;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ProductController extends ApiController
{
    private $productsTransformer;
    private $productDetailsTransformer;
    private $encodeHelper;

    function __construct(
        ProductsTransformer $productsTransformer,
        ProductDetailsTransformer $productDetailsTransformer,
        EncodeHelper $encodeHelper
    ) {
        $this->productsTransformer = $productsTransformer;
        $this->productDetailsTransformer = $productDetailsTransformer;
        $this->encodeHelper = $encodeHelper;
    }

    public function getProducts(Request $request)
    {
        $search = $request->query('search');
        $limit = $request->query('limit');
        $offset = $request->query('offset');
        $categorySlug = $request->query('category');
        $brandSlug = $request->query('brand');
        $query = Product::select('*');
        if ($search)
            $query = $query->where('name', 'like', '%' . $search . '%');
        if ($categorySlug) {
            $categoryId = Category::getCategoryIdBySlug($categorySlug);
            if (!$categoryId)
                return $this->respondNotFound('category not found');
            $categoryProductsId = ProductCategory::where('category_id', $categoryId)
                ->select('product_id')
                ->get()
                ->pluck('product_id');
            $query = $query->whereIn('id', $categoryProductsId);
        }
        if($brandSlug){
            $brandId = Vendor::getStoreIdBySlug($brandSlug);
            if(!$brandId)
                return $this->respondNotFound('brand not found');
            $query = $query->where('vendor_id', $brandId);
        }

        $totalItems = $query->count();

        if ($limit)
            $query = $query->limit($limit);
        if ($offset)
            $query = $query->offset($offset);


        $products = $query->get();
        $pageSize = $products->count();

        return $this->respond([
            'items' => $this->productsTransformer->transformCollection($products->toArray()),
            'total_items' => $totalItems,
            'page_size' => $pageSize,
            'has_more' => $totalItems <= $pageSize ? false : true
        ]);
    }

    public function getProduct(Request $request)
    {

        $sku = $request->sku;
        $product = Product::with(['images', 'categories', 'tags', 'attributes'])->where('sku', $sku)->first();
        if (!$product)
            return $this->respondNotFound('Product Not Found.');

        return $this->respond($this->productDetailsTransformer->transform($product));
    }

    public function getProductDetails($pid)
    {
        $decodedPid = $this->encodeHelper->decodeData($pid);

        $product = Product::with(['images', 'categories', 'tags', 'attributes', 'up_sells', 'cross_sells'])->find($decodedPid);

        if (!$product)
            return $this->respondNotFound('Product Not Found.');

        return $this->respond($this->productDetailsTransformer->transform($product));
    }
}
