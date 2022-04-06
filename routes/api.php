<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
Route::post('register', 'App\Http\Controllers\UserController@register');


Route::get('products', 'App\\Http\\Controllers\\ProductController@index');
Route::get('products/{product}', 'App\\Http\\Controllers\\ProductController@show');

Route::get('deliveries', 'App\\Http\\Controllers\\DeliveryController@index');
Route::get('deliveries/{deliveries}', 'App\\Http\\Controllers\\DeliveryController@show');

Route::get('categories', 'App\\Http\\Controllers\\CategoryController@index');
Route::get('categories/{category}', 'App\\Http\\Controllers\\CategoryController@show');

Route::get('colors', 'App\\Http\\Controllers\\ColorController@index');
Route::get('colors/{color}', 'App\\Http\\Controllers\\ColorController@show');

Route::get('rooms', 'App\\Http\\Controllers\\RoomController@index');
Route::get('rooms/{room}', 'App\\Http\\Controllers\\RoomController@show');

Route::get('prices', 'App\\Http\\Controllers\\PriceController@index');
Route::get('prices/{price}', 'App\\Http\\Controllers\\PriceController@show');

Route::get('images', 'App\\Http\\Controllers\\ImageController@index');
Route::get('images/{image}', 'App\\Http\\Controllers\\ImageController@show');



Route::post('/forgot-password',function (Request $request){
    $request->validate(['email'=>'required|email']);
    $status=Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
        ? response()->json(['status'=>__($status)],200)
        : response()->json(['status'=>__($status)],400);
})->middleware('guest')->name('password.email');



Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
        ? response()->json(['status' => __($status)], 200)
        : response()->json(['status' => __($status)], 400);
});


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', 'App\Http\Controllers\UserController@logout');

    Route::get('users', 'App\Http\Controllers\UserController@index');
    Route::get('users/all', 'App\Http\Controllers\UserController@showAll');
    Route::get('user', 'App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('users/{user}', 'App\Http\Controllers\UserController@show');
    Route::put('users/{user}', 'App\Http\Controllers\UserController@update');
    Route::delete('users/{user}', 'App\Http\Controllers\UserController@delete');

    /* Administrador */ 
    //Categories 
    Route::post('categories', 'App\\Http\\Controllers\\CategoryController@store');
    Route::put('categories/{category}', 'App\\Http\\Controllers\\CategoryController@update');
    Route::delete('categories/{category}', 'App\\Http\\Controllers\\CategoryController@delete');
    //Products
    Route::post('products', 'App\\Http\\Controllers\\ProductController@store');
    Route::put('products/{product}', 'App\\Http\\Controllers\\ProductController@update');
    Route::put('products/{product}/colors', 'App\\Http\\Controllers\\ProductController@updateColors');
    Route::post('products/{product}/images', 'App\\Http\\Controllers\\ProductController@uploadSubmit');
    Route::delete('products/{product}', 'App\\Http\\Controllers\\ProductController@delete');
    //Deliveries
    Route::post('deliveries', 'App\\Http\\Controllers\\DeliveryController@store');
    Route::put('deliveries/{delivery}', 'App\\Http\\Controllers\\DeliveryController@update');
    Route::delete('deliveries/{delivery}', 'App\\Http\\Controllers\\DeliveryController@delete');
    //Rooms
    Route::post('rooms', 'App\\Http\\Controllers\\RoomController@store');
    Route::put('rooms/{room}', 'App\\Http\\Controllers\\RoomController@update');
    Route::delete('rooms/{room}', 'App\\Http\\Controllers\\RoomController@delete');
    //Prices
    Route::post('prices', 'App\\Http\\Controllers\\PriceController@store');
    Route::put('prices/{price}', 'App\\Http\\Controllers\\PriceController@update');
    Route::delete('prices/{price}', 'App\\Http\\Controllers\\PriceController@delete');
    //Images
    Route::post('images', 'App\\Http\\Controllers\\ImageController@store');
    Route::put('images/{image}', 'App\\Http\\Controllers\\ImageController@update');
    Route::delete('images/{image}', 'App\\Http\\Controllers\\ImageController@delete');
    //Colors
    Route::post('colors', 'App\\Http\\Controllers\\ColorController@store');
    Route::put('colors/{color}', 'App\\Http\\Controllers\\ColorController@update');
    Route::delete('colors/{color}', 'App\\Http\\Controllers\\ColorController@delete');



    /* Usuarios y Administrador*/ 

    //Orders    
    Route::get('orders', 'App\\Http\\Controllers\\OrderController@index');
    Route::get('orders/{order}', 'App\\Http\\Controllers\\OrderController@show');
    Route::post('orders', 'App\\Http\\Controllers\\OrderController@store');
    Route::put('orders/{order}', 'App\\Http\\Controllers\\OrderController@update');
    Route::delete('orders/{order}', 'App\\Http\\Controllers\\OrderController@delete');

    //Bills 
    Route::get('bills', 'App\\Http\\Controllers\\BillController@index');
    Route::get('bills/{bill}', 'App\\Http\\Controllers\\BillController@show');
    Route::post('bills', 'App\\Http\\Controllers\\BillController@store');
    Route::put('bills/{bill}', 'App\\Http\\Controllers\\BillController@update');
    Route::delete('bills/{bill}', 'App\\Http\\Controllers\\BillController@delete');

    
});


