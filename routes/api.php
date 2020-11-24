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
	Route::get('user-profile', 'AuthController@userProfile');

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
	Route::get('wishlist/mine', 'WishlistController@getUserWishlist');
	Route::post('wishlist/mine', 'WishlistController@store');
	Route::delete('wishlist/mine/{id}', 'WishlistController@remove');
});
