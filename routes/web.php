<?php

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

//Route::get('/{any}', function () {
//  return view('app');
//})->where('any', '.*');

//Auth::routes(); // Registerなども追加されてしまうためコメントアウト

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'AppController@index')->name('app');

Route::get('/{any}', function () {
  return redirect()->route('login');
})->where('any', '.*');

//Route::get('/users', function () {
//  return view('app');
//});
