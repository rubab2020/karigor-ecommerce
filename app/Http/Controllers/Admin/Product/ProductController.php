<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
// use App\Models\ProductImage;
// use App\Models\ProductAttribute;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Tag;
use App\Models\ProductUpSell;
use App\Models\ProductCrossSell;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\ProductTag;
use App\Karigor\Helpers\CustomHelper;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('images', 'attributes')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Vendors = Vendor::pluck('name', 'id')->toArray();
        $categories = Category::getParentChildCategories();
        $attributes = Attribute::pluck('name', 'id')->toArray();
        $attributeOptions = AttributeOption::getAttributeMappedOptions();
        $tags = Tag::pluck('name', 'id')->toArray();
        $products = Product::pluck('name', 'id')->toArray();

        return view('admin.products.create', compact(
            'Vendors',
            'categories',
            'attributes',
            'attributeOptions',
            'tags',
            'products'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {

        $lastProductId =  Product::getLastDataId();
        $photoUploadPath = Product::getPhotoPath($lastProductId);

        $imageBgName = CustomHelper::saveImage($request->file('image'), $photoUploadPath, 600, 600);
        $imageSmName = CustomHelper::saveImage($request->file('image'), $photoUploadPath, 300, 300);

        $product->vendor_id = $request->input('vendor_id') ?? 1; //should be validated
        $product->name = $request->input('name');
        $product->slug = \Str::slug($request->input('name'), '-');
        $product->image_bg = $imageBgName ?? "aa";  //should be validated
        $product->image_sm = $imageSmName ?? "bb";  // should be validated
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->sale_price = $request->input('sale_price') ?? 0; //should be validated
        $product->sale_price_from = $request->input('sale_price_from');
        $product->sale_price_to = $request->input('sale_price_to');
        $product->discount_percent = $request->input('sale_price') / $request->input('price') * 100; //discount, should be inserted from form
        $product->sku = $request->input('sku');
        $product->stock_quantity = $request->input('stock_quantity') ?? 100; //should be validated;
        $product->low_stock_threshold = $request->input('low_stock_threshold');
        $product->weight = $request->input('weight');
        $product->purchase_note = $request->input('purchase_note');

        if ($product->save()) {
            $this->saveImages($request->file('images'), $product->id);
            $this->saveCategories($request->input('categories'), $request->input('sub_categories'), $product->id);
            $this->saveAttributes($request->input('attribute'), $request->input('attribute_options'), $product->id);
            $this->saveTags($request->input('tags'), $product->id);
            $this->saveLinkedProducts($request->input('up_sells'), $request->input('cross_sells'), $product->id);
        }

        return redirect(route('categories.index'))->with('success', 'Saved');
    }

    private function saveImages($images, $productId)
    {
        if ($images) {
            foreach ($images as $image) {
                $imageBgName = $imageSmName = $photoUploadPath = null;

                $photoUploadPath = Product::getPhotoPath($product->id);
                $imageBgName = CustomHelper::saveImage($image, $photoUploadPath, 600, 600);
                $imageSmName = CustomHelper::saveImage($image, $photoUploadPath, 600, 600);

                $pImage = new ProductImage;
                $pImage->image_bg = $imageBgName;
                $pImage->image_sm = $imageSmName;
                $pImage->product_id = $productId;
                $pImage->save();
            }
        }
    }

    private function saveCategories($categories, $subCategoires, $productId)
    {
        foreach ($categories as $category) {
            $newCategory = new ProductCategory;
            $newCategory->product_id = $productId;
            $newCategory->category_id = $category;
            $newCategory->save();  
        }
        if ($subCategoires) //checking if null
            foreach ($subCategoires as $category) {
                $newCategory = new ProductCategory;
                $newCategory->product_id = $productId;
                $newCategory->category_id = $category;
                $newCategory->save();
            }
    }

    private function saveAttributes($attribute, $attributeOptions, $productId)
    {
        if ($attributeOptions)  // checkif if null, 
            foreach ($attributeOptions as $attrOption) {
                $option = new ProductAttribute;
                $option->product_id = $productId;
                $option->attribute = $attribute;
                $option->value = $attrOption;
                $option->save();
            }
    }

    private function saveTags($tags, $productId)
    {
        if ($tags)  // checking if null
            foreach ($tags as $tag) {
                $option = new ProductAttribute;
                $option->product_id = $productId;
                $option->tag_id = $tag;
                $option->save();
            }
    }

    private function saveLinkedProducts($upsells, $crossSells, $productId)
    {
        if ($upsells)
            foreach ($upsells as $upsell) {
                $product = new ProductUpSell;
                $product->parent_id = $productId;
                $product->child_id = $upsell;
                $product->save();
            }
        if ($crossSells)
            foreach ($crossSells as $upsell) {
                $product = new ProductCrossSell;
                $product->parent_id = $productId;
                $product->child_id = $upsell;
                $product->save();
            }
    }
}
