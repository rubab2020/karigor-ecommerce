<?php

namespace App\Karigor\Transformers;

use App\Karigor\Transformers\Transformer;
use App\Karigor\Helpers\EncodeHelper;
use App\Models\Product;
use App\Models\Vendor;

class ProductsTransformer extends Transformer
{
    /**
     * @var App\Helpers\EncodeHelper
     **/
    private $encodeHelper;

    private $baseUrl;

    function __construct(EncodeHelper $encodeHelper)
    {
        $this->encodeHelper = $encodeHelper;
        $this->baseUrl = \URL::to('/');
    }

    /**
     * transform a object for mapping between api parameters and database columns
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transform($product)
    {
        return [
            'id' => $product['id'],
            'url' => $this->baseUrl.$product['slug'],
            'name' => $product['name'],
            'price' => $product['price'],
            'sale_price' => Product::getSalePrice(
                $product['sale_price'],
                $product['sale_price_from'],
                $product['sale_price_to']
            ),
            'sku' => $product['sku'],
            'vendor' => [
                'name' => Vendor::getVendorName($product['vendor_id']),
                'store_url' => $this->baseUrl.Vendor::getStoreSlug($product['vendor_id'])
            ],
            'image_bg' => Product::getPhotoUrl($product['image_bg'], $product['id']),
            'image_sm' => Product::getPhotoUrl($product['image_sm'], $product['id']),
        ];
    }
}
