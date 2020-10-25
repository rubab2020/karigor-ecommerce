<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// user routes

Auth::routes(['verify' => true]);
// Route::get('/home', 'HomeController@index')->name('home');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::resource('blogs', 'Admin\BlogController');
    Route::resource('blog-categories', 'Admin\BlogCategoryController');

    // routes for slider
    Route::resource('sliders', 'Admin\SliderController');

    Route::get('settings/edit', 'Admin\SettingController@edit');
    Route::post('settings/update', 'Admin\SettingController@update');

    Route::get('contact-us/inbox', function () {
        $inboxes = App\Models\ContactUs::all();
        return view('admin.contactus-inbox', compact('inboxes'));
    });

    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('attributes', 'Admin\AttributeController');
    Route::resource('attribute-options', 'Admin\AttributeOptionController');
    Route::resource('tags', 'Admin\TagController');
});


// Vendor routes
Route::prefix('vendor')->group(function () {
    Route::get('/login', 'Auth\VendorLoginController@showLoginForm')->name('vendor.login');
    Route::post('/login', 'Auth\VendorLoginController@login')->name('vendor.login.submit');
    Route::get('/register', 'Auth\VendorRegisterController@showRegisterForm')->name('vendor.register');
    Route::post('/register', 'Auth\VendorRegisterController@register')->name('vendor.register.submit');

    Route::get('/dashboard', 'Vendor\DashboardController@index')->name('vendor.dashboard');
});

Route::post('editor-image-upload', 'CKEditorController@uploadEditorImage')->name('editor-image-upload');
