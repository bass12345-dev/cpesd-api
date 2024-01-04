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

//Auth
Route::post('/verify-code', 'App\Http\Controllers\Api\AuthController@verify_code');
Route::post('/verify-user', 'App\Http\Controllers\Api\AuthController@verify_user');

Route::post('/verify-admin', 'App\Http\Controllers\Api\AuthController@verify_admin');

Route::post('/change-code', 'App\Http\Controllers\Api\AuthController@change_code');


Route::get('qr', 'App\Http\Controllers\Api\DocumentController@qr');

//Blacklisted

//POST

Route::post('/verify-b-user', 'App\Http\Controllers\Api\AuthController@verify_b_user');

Route::apiResource('person', PersonController::class);
Route::post('/add', 'App\Http\Controllers\Api\PersonController@add');
Route::post('/search-query', 'App\Http\Controllers\Api\PersonController@search_query');
Route::post('remove','App\Http\Controllers\Api\PersonController@remove');
Route::post('set-active','App\Http\Controllers\Api\PersonController@set_active');
Route::post('delete', 'App\Http\Controllers\Api\PersonController@delete');

//Update
Route::put('update/{id}','App\Http\Controllers\Api\PersonController@update');

Route::put('add_record/{id}', 'App\Http\Controllers\Api\PersonController@add_record');
Route::put('update_record/{id}', 'App\Http\Controllers\Api\PersonController@update_record');
Route::put('update-person-info/{id}', 'App\Http\Controllers\Api\PersonController@update_person_info');

//Get
Route::get('person_info', 'App\Http\Controllers\Api\PersonController@person_info');
Route::get('get_records', 'App\Http\Controllers\Api\PersonController@get_records');
Route::get('count_all', 'App\Http\Controllers\Api\PersonController@count_all');
Route::get('check_person', 'App\Http\Controllers\Api\PersonController@check_person');

Route::get('data-per-barangay', 'App\Http\Controllers\Api\PersonController@data_per_barangay');
Route::get('data-per-year', 'App\Http\Controllers\Api\PersonController@data_per_year');


//Programs
Route::post('add-program', 'App\Http\Controllers\Api\ProgramController@add_program');
Route::get('get-programs', 'App\Http\Controllers\Api\ProgramController@get_programs');
Route::delete('delete-program/{id}', 'App\Http\Controllers\Api\ProgramController@delete_program');
Route::put('update_program/{id}', 'App\Http\Controllers\Api\ProgramController@update_program');

Route::post('save-person-program', 'App\Http\Controllers\Api\ProgramController@save_person_program');
Route::get('get-person-programs', 'App\Http\Controllers\Api\ProgramController@get_person_programs');


//Delete

Route::delete('delete-record/{id}', 'App\Http\Controllers\Api\PersonController@delete_record');


//Document Tracker

//Checking
Route::post('/verify-dt-user', 'App\Http\Controllers\Api\AuthController@verify_dt_user');
Route::post('/verify-dt-admin', 'App\Http\Controllers\Api\AuthController@verify_dt_admin');

//Dashboard
Route::get('count-doc-t', 'App\Http\Controllers\Api\DocumentController@countmydoc_dash');
Route::get('get-transaction-today', 'App\Http\Controllers\Api\DocumentController@get_transaction_today');
//Get 

//Users
Route::get('get-users', 'App\Http\Controllers\Api\UserController@get_users');
Route::get('get-user-data', 'App\Http\Controllers\Api\UserController@get_user_data');
Route::post('register', 'App\Http\Controllers\Api\UserController@register');
Route::put('remove-user/{id}', 'App\Http\Controllers\Api\UserController@remove_user');


//Document types
Route::get('get-document-types', 'App\Http\Controllers\Api\DocumentTypeController@get_document_types');
Route::post('add-document-type', 'App\Http\Controllers\Api\DocumentTypeController@add_document_type');
Route::delete('delete-type/{id}', 'App\Http\Controllers\Api\DocumentTypeController@delete_type');
Route::put('update_type/{id}', 'App\Http\Controllers\Api\DocumentTypeController@update_type');



//Final Actions
Route::get('get-actions', 'App\Http\Controllers\Api\FinalActionsController@get_final_actions');
Route::post('add-action', 'App\Http\Controllers\Api\FinalActionsController@add_action');
Route::delete('delete-action/{id}', 'App\Http\Controllers\Api\FinalActionsController@delete_action');
Route::put('update_action/{id}', 'App\Http\Controllers\Api\FinalActionsController@update_action');


//Documents
Route::post('add-document', 'App\Http\Controllers\Api\DocumentController@add_document');
Route::get('get-my-documents', 'App\Http\Controllers\Api\DocumentController@get_my_documents');
Route::post('delete-my-document', 'App\Http\Controllers\Api\DocumentController@delete_my_document');
Route::put('update_document/{id}', 'App\Http\Controllers\Api\DocumentController@update_document');

Route::post('filter-by-date', 'App\Http\Controllers\Api\DocumentController@filter_by_date');


//Offices
Route::post('add-office', 'App\Http\Controllers\Api\OfficeController@add_office');
Route::get('offices', 'App\Http\Controllers\Api\OfficeController@offices');
Route::delete('delete-office/{id}', 'App\Http\Controllers\Api\OfficeController@delete_office');
Route::put('update_office/{id}', 'App\Http\Controllers\Api\OfficeController@update_office');


// History 
Route::get('get-received-documents', 'App\Http\Controllers\Api\DocumentController@get_received_documents');
Route::post('forward-document', 'App\Http\Controllers\Api\DocumentController@forward_document');
Route::get('get-forwarded-documents', 'App\Http\Controllers\Api\DocumentController@get_forward_documents');
Route::get('get-incoming-documents', 'App\Http\Controllers\Api\DocumentController@get_incoming_documents');
Route::post('receive-document', 'App\Http\Controllers\Api\DocumentController@receive_document');

Route::post('complete-document', 'App\Http\Controllers\Api\DocumentController@complete_document');

Route::get('get-history', 'App\Http\Controllers\Api\DocumentController@get_history');
Route::get('get-document-data', 'App\Http\Controllers\Api\DocumentController@get_document_data');


Route::get('track-document', 'App\Http\Controllers\Api\DocumentController@track_document');



//Admin


//Get
Route::get('get-all-documents', 'App\Http\Controllers\Api\DocumentController@get_all_documents');
Route::get('count-docs', 'App\Http\Controllers\Api\DocumentController@countadmindoc_dash');


Route::get('get-last', 'App\Http\Controllers\Api\DocumentController@get_last');