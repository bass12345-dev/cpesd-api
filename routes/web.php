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
  echo 'welcome';
});

Route::get('/dts', function () {
    return view('auth.login');
});



Route::prefix('dts/admin')->group(function  () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
}); 

Route::prefix('dts/user')->group(function  () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);
}); 