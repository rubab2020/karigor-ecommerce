<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
// use App\Models\ProductImage;
// use App\Models\ProductAttribute;
use App\Vendor;
// use App\Models\Category;
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
        $merchants = Vendor::pluck('name', 'id')->toArray();

        $categories = Category::parentCategories();
        return view('admin.products.create', compact('categories', 'merchants'));
    }		
}