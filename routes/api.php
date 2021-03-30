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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','Api\AuthController@login');
Route::post('/register','Api\AuthController@register');
Route::post('/logout','Api\AuthController@logout')->middleware('auth:sanctum');
Route::apiResource('post', 'Api\PostController', ['only' => [
    'index', 'show'
]]);
Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::apiResource('post', 'Api\PostController', ['only' => [
        'store', 'edit','update','destroy'
    ]]);
    Route::put('users/{id}','Api\AuthController@editUser');
});