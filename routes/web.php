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
    return view('site.home');
});

Route::get('/checkout', function () {
    return view('site.checkout');
});

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});

Route::get('/admin', function(){
    return redirect('/admin/dashboard');
});

Route::get('/admin/{any}', 'SecureController@index')->where('any', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Route to get the current cart session */
Route::get('/get-cart-session', 'SiteController@getCartSession');
Route::post('/store-sale', 'SiteController@storeSale');

/* Route to get product details by slug */
Route::get('/{slug}', 'Api\v1\ProductsController@show');

Route::get('/checkout', 'SiteController@checkout');

/* Route to add product to session cart */
Route::post('/add-product-to-cart', 'SiteController@addProductToCart');
