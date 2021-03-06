<?php

use Illuminate\Http\Request;

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

Route::get('/salary', 'SalaryController@index');
Route::post('/salary', 'SalaryController@store');
Route::get('/statement', 'SalaryController@statement');
Route::put('/sync', 'SalaryController@sync');
Route::post('/commit', 'SalaryController@commit');
Route::get('/summary', 'SalaryController@summary');