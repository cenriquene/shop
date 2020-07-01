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

Route::group(['middleware' => ['json-response']], function () {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/login', 'Api\AuthController@login')->name('login.api');
    Route::post('/register', 'Api\AuthController@register')->name('register.api');

    Route::middleware('auth:api')->namespace('Api\\v1')->prefix('v1')->group(function () {
        /* Products endpoints */
        Route::get('products', 'ProductsController@index');
        Route::get('products/{id}', 'ProductsController@getProductById');
        Route::post('products', 'ProductsController@store');
        Route::put('products/{id}', 'ProductsController@update');
        Route::delete('products/{id}', 'ProductsController@destroy');

        /* Categories endpoints */
        Route::get('categories', 'CategoriesController@index');

        /* Sales endpoints */
        Route::get('sales', 'SalesController@index');

        /* Users endpoints */
        Route::get('users', 'UsersController@index');
        Route::get('users/{id}', 'UsersController@show');
        Route::post('users', 'UsersController@store');
        Route::put('users/{id}', 'UsersController@update');
        Route::delete('users/{id}', 'UsersController@destroy');
    });
});
