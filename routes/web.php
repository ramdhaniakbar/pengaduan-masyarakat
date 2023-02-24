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


Route::get('/', 'App\Http\Controllers\PagesController@index')->name('index');

// Routes guest 
Route::group(['middleware' => ['guest']], function () {
    // Authentication Routes
    Route::get('/register', 'App\Http\Controllers\AuthController@showRegister')->name('register');
    Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register.store');
    Route::get('/login', 'App\Http\Controllers\AuthController@showLogin')->name('login');
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login.store');
});

// Authenticated Routes
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::resource('complaint', 'App\Http\Controllers\ComplaintController');

    Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['is_admin']], function () {
        Route::get('/dashboard', 'App\Http\Controllers\DashboardBacksiteController@index')->name('dashboard');
        Route::get('/create_response', 'App\Http\Controllers\DashboardBacksiteController@createResponse')->name('create_response');
    });
   
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
});