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

Auth::routes();

// Centralized Route
Route::middleware('auth')
->name('admin.')
->namespace('Admin')
->prefix('admin')
->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('todos', 'TodoController');
});

// For any route returns  view frontend page
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');


