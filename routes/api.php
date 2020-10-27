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

	Route::get('categories', 'CategoryController@getCategories');
	Route::get('sliders', 'SliderController@getSliders');
	Route::get('blogCategories', 'Blog\BlogCategoryController@getBlogCategories');
});
