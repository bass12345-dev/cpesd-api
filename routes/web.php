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
    Route::get('/all-documents', [App\Http\Controllers\Admin\AllDocumentsController::class, 'index']);
    Route::get('/offices', [App\Http\Controllers\Admin\OfficesController::class, 'index']);
    Route::get('/doc-types', [App\Http\Controllers\Admin\DocTypesController::class, 'index']);
    Route::get('/final-actions', [App\Http\Controllers\Admin\FinalActionsController::class, 'index']);
    Route::get('/manage-users', [App\Http\Controllers\Admin\ManageUsersController::class, 'index']);
}); 



//USER ROUTES//
Route::prefix('dts/user')->group(function  () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);
    Route::get('/my-documents', [App\Http\Controllers\User\MyDocumentsController::class, 'index']);
    Route::get('/add-document', [App\Http\Controllers\User\AddDocumentController::class, 'index']);
    Route::get('/incoming', [App\Http\Controllers\User\IncomingController::class, 'index']);
    Route::get('/received', [App\Http\Controllers\User\ReceivedController::class, 'index']);
    Route::get('/forwarded', [App\Http\Controllers\User\ForwardedController::class, 'index']);
    Route::get('/view', [App\Http\Controllers\User\ViewDocumentController::class, 'index']);
}); 






