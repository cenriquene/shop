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
