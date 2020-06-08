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

//Route::get('users', 'AuthController@index');
Route::post('login', 'AuthController@login');
//Route::post('register', 'AuthController@register');
Route::resource('manage-users', 'AdminController');
Route::post('add-doctor', 'AdminController@add_doctor');
Route::get('doctors-list', 'AdminController@doctors_list');

Route::resource('role', 'RoleController');
Route::resource('status', 'StatusController');
Route::resource('patient', 'PatientController');
Route::resource('district', 'DistrictController');
