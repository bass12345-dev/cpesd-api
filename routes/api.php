<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Blacklisted

//POST
Route::apiResource('person', PersonController::class);
Route::post('/add', 'App\Http\Controllers\Api\PersonController@add');
Route::post('/search-query', 'App\Http\Controllers\Api\PersonController@search_query');


//Update
Route::put('update/{id}','App\Http\Controllers\Api\PersonController@update');
Route::put('remove/{id}','App\Http\Controllers\Api\PersonController@remove');
Route::put('set-active/{id}','App\Http\Controllers\Api\PersonController@set_active');
Route::put('add_record/{id}', 'App\Http\Controllers\Api\PersonController@add_record');

//Get
Route::get('person_info', 'App\Http\Controllers\Api\PersonController@person_info');
Route::get('get_records', 'App\Http\Controllers\Api\PersonController@get_records');
Route::get('count_all', 'App\Http\Controllers\Api\PersonController@count_all');

//Delete
Route::delete('delete/{id}', 'App\Http\Controllers\Api\PersonController@delete');
Route::delete('delete-record/{id}', 'App\Http\Controllers\Api\PersonController@delete_record');