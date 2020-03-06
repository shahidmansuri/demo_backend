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


Route::group(['prefix' => 'v1'], function()
{
    /**
     * Non Auth Routes
     */
    Route::post('/register', 'Api\AuthController@register');
    Route::post('/login', 'Api\AuthController@login');
    
    /**
     * Auth Routes
     * Note: Requires JWT in header.
     * Authorization: Bearer <JWT>
     */
    Route::group(['middleware' => 'jwt.auth'], function()
    {
        Route::get('/logout', 'Api\AuthController@logout');
        Route::get('/user', 'Api\ProfileController@user');

        Route::post('/process-type/create', 'Api\ProcessesTypeController@create');
        Route::post('/process-type/edit', 'Api\ProcessesTypeController@edit');
        Route::delete('/process-type/delete', 'Api\ProcessesTypeController@delete');
    });
});
