<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'HtmlMinifier'], function () {
    /* *************Front End************* */
    Route::get('update-cart-ajax', 'CartController@update');
    Route::resource('checkout', 'CheckoutController');
    Route::get('/', 'LandingPageController@index')->name('home');
    Route::get('shop', 'ShopController@index')->name('shop');
    Route::get('product-details/{product}', 'ShopController@show')->name('product-details');
    Route::get('filter', 'ShopController@filter');
    Route::get('all-blogs', 'NewsController@index');
    Route::get('blog-details/{blog}', 'NewsController@show')->name('blog-details');
    Route::get('contact/create', 'ContactController@create')->name('contact.create');
    Route::post('contact', 'ContactController@store');
    Route::get('order-checking', 'OrderCheckController@index');
    Route::post('order-checking', 'OrderCheckController@check')->name('checking-order');
    Route::get('get-colors/{product}/{size}', 'AjaxController@getColor');
    Route::get('get-attribute', 'AjaxController@getAttribute');
    Route::get('districts/{province}', 'AjaxController@getDistrict');
    Route::get('wards/{district}', 'AjaxController@getWards');

    Route::middleware(['auth'])->group(function () {
        Route::resource('cart', 'CartController');
        Route::resource('wishlist', 'WishListController');
        Route::get('edit-profile', 'ProfileController@editProfile')->name('edit-profile');
        Route::post('edit-profile', 'ProfileController@updateProfile');
        Route::get('edit-password', 'ProfileController@editPassword');
        Route::post('edit-password', 'ProfileController@updatePassword');
    });

    /* *************Back End************* */
    Route::middleware(['auth', 'is_staff', 'mark_as_read'])->group(function () {
        Route::get('products/attributes', 'AjaxController@getAllAttributes');
        Route::resource('categories', 'CategoryController');
        Route::resource('send-email', 'SendEmailController');
        Route::resource('sub-categories', 'SubCategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('sizes', 'SizeController');
        Route::resource('colors', 'ColorController');
        Route::resource('roles', 'RoleController');
        Route::resource('orders', 'OrderController');
        Route::resource('customers', 'CustomerController');
        Route::resource('tags', 'TagController');
        Route::resource('blogs', 'BlogController');
        Route::get('contact', 'ContactController@index');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('assign-roles/{role}', 'AssignRoleController@index')->name('assign-roles.index');
        Route::post('assign-roles/{role}', 'AssignRoleController@store')->name('assign-roles.store');
        Route::get('mark-all-as-read', 'NotificationController@markAllAsRead')->name('mark-all-as-read');
    });
    Route::get('auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('callback/{provider}', 'SocialController@callback');
    Auth::routes();
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});
