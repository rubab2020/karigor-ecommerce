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
// use App\Karigor\CustomHelper;

class ProductController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('images', 'productAttributes')->get();

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

        // $categories = Category::parentCategories();
        return view('admin.products.create', compact('Vendors', 'categories', 'attributes', 'attributeOptions'));
    }		
}