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


Route::post('login', 'App\Http\Controllers\UserController@authenticate');


Route::get('products', 'App\\Http\\Controllers\\ProductController@index');
Route::get('products/{product}', 'App\\Http\\Controllers\\ProductController@show');

Route::get('deliveries', 'App\\Http\\Controllers\\DeliveryController@index');
Route::get('deliveries/{deliveries}', 'App\\Http\\Controllers\\DeliveryController@show');


Route::get('categories', 'App\\Http\\Controllers\\CategoryController@index');
Route::get('categories/{category}', 'App\\Http\\Controllers\\CategoryController@show');
Route::post('categories', 'App\\Http\\Controllers\\CategoryController@store');
Route::put('categories/{category}', 'App\\Http\\Controllers\\CategoryController@update');
Route::delete('categories/{category}', 'App\\Http\\Controllers\\CategoryController@delete');

Route::get('colors', 'App\\Http\\Controllers\\ColorController@index');
Route::get('colors/{color}', 'App\\Http\\Controllers\\ColorController@show');
Route::post('colors', 'App\\Http\\Controllers\\ColorController@store');
Route::put('colors/{color}', 'App\\Http\\Controllers\\ColorController@update');
Route::delete('colors/{color}', 'App\\Http\\Controllers\\ColorController@delete');

Route::get('images', 'App\\Http\\Controllers\\ImageController@index');
Route::get('images/{image}', 'App\\Http\\Controllers\\ImageController@show');
Route::post('images', 'App\\Http\\Controllers\\ImageController@store');
Route::put('images/{image}', 'App\\Http\\Controllers\\ImageController@update');
Route::delete('images/{image}', 'App\\Http\\Controllers\\ImageController@delete');

Route::get('orders', 'App\\Http\\Controllers\\OrderController@index');
Route::get('orders/{order}', 'App\\Http\\Controllers\\OrderController@show');
Route::post('orders', 'App\\Http\\Controllers\\OrderController@store');
Route::put('orderss/{order}', 'App\\Http\\Controllers\\OrderController@update');
Route::delete('orders/{order}', 'App\\Http\\Controllers\\OrderController@delete');

Route::get('rooms', 'App\\Http\\Controllers\\RoomController@index');
Route::get('rooms/{room}', 'App\\Http\\Controllers\\RoomController@show');
Route::post('rooms', 'App\\Http\\Controllers\\RoomController@store');
Route::put('rooms/{room}', 'App\\Http\\Controllers\\RoomController@update');
Route::delete('rooms/{room}', 'App\\Http\\Controllers\\RoomController@delete');

Route::get('bills', 'App\\Http\\Controllers\\BillController@index');
Route::get('bills/{bill}', 'App\\Http\\Controllers\\BillController@show');
Route::post('bills', 'App\\Http\\Controllers\\BillController@store');
Route::put('bills/{bill}', 'App\\Http\\Controllers\\BillController@update');
Route::delete('bills/{bill}', 'App\\Http\\Controllers\\BillController@delete');

Route::get('prices', 'App\\Http\\Controllers\\PriceController@index');
Route::get('prices/{price}', 'App\\Http\\Controllers\\PriceController@show');
Route::post('prices', 'App\\Http\\Controllers\\PriceController@store');
Route::put('prices/{price}', 'App\\Http\\Controllers\\PriceController@update');
Route::delete('prices/{price}', 'App\\Http\\Controllers\\PriceController@delete');


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', 'App\Http\Controllers\UserController@logout');

    Route::get('users', 'App\Http\Controllers\UserController@index');
    Route::get('users/all', 'App\Http\Controllers\UserController@showAll');
    Route::get('user', 'App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('users/{user}', 'App\Http\Controllers\UserController@show');

    Route::post('register', 'App\Http\Controllers\UserController@register');
    Route::put('users/{user}', 'App\Http\Controllers\UserController@update');
    Route::delete('users/{user}', 'App\Http\Controllers\UserController@delete');

    
    
    Route::post('products', 'App\\Http\\Controllers\\ProductController@store');
    Route::put('products/{product}', 'App\\Http\\Controllers\\ProductController@update');
    Route::delete('products/{product}', 'App\\Http\\Controllers\\ProductController@delete');

    Route::post('deliveries', 'App\\Http\\Controllers\\DeliveryController@store');
    Route::put('deliveries/{delivery}', 'App\\Http\\Controllers\\DeliveryController@update');
    Route::delete('deliveries/{delivery}', 'App\\Http\\Controllers\\DeliveryController@delete');

});
