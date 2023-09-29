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

Route::apiResource('person', PersonController::class);
Route::post('/add', 'App\Http\Controllers\Api\PersonController@add');
Route::put('update/{id}','App\Http\Controllers\Api\PersonController@update');
Route::put('remove/{id}','App\Http\Controllers\Api\PersonController@remove');
Route::put('set-active/{id}','App\Http\Controllers\Api\PersonController@set_active');
Route::delete('delete/{id}', 'App\Http\Controllers\Api\PersonController@delete');
