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

Route::get('/', function(){
    return view('welcome');
});

// User
Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::get('/review', function () {
        return redirect()->route('user.create');
    });
    Route::post('/review', 'UserController@review')->name('user.review');
    Route::post('/store', 'UserController@store')->name('user.store');

    Route::get('/edit/{id}', 'UserController@show')->name('user.show');
    Route::post('/edit/{id}', 'UserController@update')->name('user.update');

    Route::delete('/delete/{id}', 'UserController@delete')->name('user.delete');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
