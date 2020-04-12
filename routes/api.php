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

Route::get('all-lists', 'API\ListsController@getLists');
Route::post('save-list', 'API\ListsController@saveList');
Route::put('update-list/{id}', 'API\ListsController@updateList');
Route::delete('delete-list/{id}', 'API\ListsController@deleteList');
