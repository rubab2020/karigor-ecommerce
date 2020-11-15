<?php

namespace App\Karigor\Transformers;

use App\Karigor\Transformers\Transformer;
use App\Karigor\Helpers\EncodeHelper;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Vendor;

class ProductDetailsTransformer extends Transformer
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
            'id' => $this->encodeHelper->encodeData($product['id']),
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
            'images' => $this->tranformImages(ProductImage::getImages($product['id'])),
            'categories' => $this->transformCategories($product['categories']),
            'attributes' => $this->transformTags($product['tags']),
            'tags' => $this->transformAttributes($product['attributes']),
            'up_sells' => $this->transformUpSells($product['up_sells']),
            'cross_sells' => $this->transformCrossSells($product['cross_sells'])
        ];
    }

    /**
     * transform collection of attributes
     *
     * @param $items
     * @return array
     **/
    public function transformImages($images)
    {
        return array_map([$this, 'transformImage'], is_array($images) ? $images : $images->toArray());
    }

    /**
     * transform sub category
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transformImage($image)
    {
        return [
            'id' => $this->encodeHelper->encodeData($image['id']),
            'image_bg' => $image['image_bg'],
            'image_sm' => $image['image_sm']
        ];
    }

    /**
     * transform collection of attributes
     *
     * @param $items
     * @return array
     **/
    public function transformCategories($categories)
    {
        return array_map([$this, 'transformCategory'], is_array($categories) ? $categories : $categories->toArray());
    }

    /**
     * transform sub category
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transformCategory($category)
    {
        return [
            'id' => $this->encodeHelper->encodeData($category['id']),
            'name' => $category['name']
        ];
    }

    /**
     * transform collection of attributes
     *
     * @param $items
     * @return array
     **/
    public function transformAttributes($attributes)
    {
        return array_map([$this, 'transformAttribute'], is_array($attributes) ? $attributes : $attributes->toArray());
    }

    /**
     * transform sub attribute
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transformAttribute($attribute)
    {
        return [
            'id' => $this->encodeHelper->encodeData($attribute['id']),
            'name' => $attribute['name']
        ];
    }

    /**
     * transform collection of attributes
     *
     * @param $items
     * @return array
     **/
    public function transformTags($tags)
    {
        return array_map([$this, 'transformTag'], is_array($tags) ? $tags : $tags->toArray());
    }

    /**
     * transform sub attribute
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transformTag($tag)
    {
        return [
            'id' => $this->encodeHelper->encodeData($tag['id']),
            'name' => $tag['name']
        ];
    }

    /**
     * transform collection of attributes
     *
     * @param $items
     * @return array
     **/
    public function transformUpSells($upSells)
    {
        return array_map([$this, 'transformUpSell'], is_array($upSells) ? $upSells : $upSells->toArray());
    }

    /**
     * transform sub attribute
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transformUpSell($upSell)
    {
        return [
            'id' => $this->encodeHelper->encodeData($upSell['id'])
        ];
    }


    /**
     * transform collection of attributes
     *
     * @param $items
     * @return array
     **/
    public function transformCrossSells($crossSells)
    {
        return array_map([$this, 'transformCrossSell'], is_array($crossSells) ? $crossSells : $crossSells->toArray());
    }

    /**
     * transform sub attribute
     *
     * @param array of objects $jobs
     * @return array
     **/
    public function transformCrossSell($crossSell)
    {
        return [
            'id' => $this->encodeHelper->encodeData($crossSell['id'])
        ];
    }
}
