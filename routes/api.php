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

Route::group(["namespace" => "App\Http\Controllers\API"],function(){

    Route::group(["prefix" => "/auth"],function(){
        Route::post('/login', 'AuthController@login');

        Route::group(["middleware" => "jwt.verify"],function(){
            Route::get('/logout', 'AuthController@logout');
            Route::get('/refresh', 'AuthController@refresh');
        });
        
    });

    Route::group(["prefix" => "/search" , "middleware" => "jwt.verify"],function(){
        Route::get('/province', 'WilayahController@province');
        Route::get('/cities', 'WilayahController@cities');
    });
});

