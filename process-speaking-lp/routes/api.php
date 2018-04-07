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

Route::post('/form-process/kenSpeakingLp', 'SpeakingLpProcessController@store');
Route::post('/form-process/livece', 'LiveceController@store');

Route::post('/form-process/save-cart', 'CeSelectorController@store');
