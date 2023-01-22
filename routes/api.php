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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Create new Todo
Route::post('/save-new-todo', 'Api\TodoController@store');

// Read Todo list
Route::get('/todos', 'Api\TodoController@index'); 

// Update Todo
Route::delete('/todos/{id}', 'Api\TodoController@edit'); 

// Update order position
Route::post('/save-todo-order', 'Api\TodoController@update');
 
// Delete Todo
Route::delete('/delete-todo/{id}', 'Api\TodoController@destroy'); 


