<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
	'middleware' => 'api',
	'namespace' => 'Api'
], function ($router) {
	// auth
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh-token', 'AuthController@refreshToken');
	Route::get('profiles/mine', 'AuthController@userProfile');

	// settings
	Route::get('sliders', 'SliderController@getSliders');

	//categories
	Route::get('categories', 'CategoryController@getCategories');
	Route::get('categories/{slug}', 'CategoryController@getCategory');

	// blogs
	Route::get('blogCategories', 'Blog\BlogCategoryController@getBlogCategories');

	// products
	Route::get('products', 'ProductController@getProducts');
	Route::get('products/{sku}', 'ProductController@getProduct');

	// wishlist
	Route::get('wishlists/mine', 'WishlistController@getUserWishlist');
	Route::post('wishlists/mine', 'WishlistController@store');
	Route::delete('wishlists/mine/{id}', 'WishlistController@remove');

	//cart
	Route::resource('carts/mine', 'CartController');

	//cart item
	Route::resource('/carts/mine/items', 'CartItemController');

	//home
	Route::get('home', 'HomeController@getHome');

	//order
	Route::get('order/delivery-charge', 'OrderController@getDeliveryCharge');
	Route::post('order/place-order', 'OrderController@placeOrder');

});
