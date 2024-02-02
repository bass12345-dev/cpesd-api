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


//ADMIN ROUTES//
Route::prefix('dts/admin')->group(function  () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
}); 



//USER ROUTES//
Route::prefix('dts/user')->group(function  () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);
    Route::get('/my-documents', [App\Http\Controllers\User\MyDocumentsController::class, 'index']);
    Route::get('/add-document', [App\Http\Controllers\User\AddDocumentController::class, 'index']);
    Route::get('/incoming', [App\Http\Controllers\User\IncomingController::class, 'index']);
    Route::get('/received', [App\Http\Controllers\User\ReceivedController::class, 'index']);
    Route::get('/forwarded', [App\Http\Controllers\User\ForwardedController::class, 'index']);
}); 






