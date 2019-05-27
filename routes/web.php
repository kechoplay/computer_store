<?php

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
    return view('welcome');
});

//Route::group(['prefix' => 'error'], function () {
//    Route::get('403', ['as' => '403', function () {
//        return view('errors.403');
//    }]);
//
//    Route::get('404', ['as' => '404', function () {
//        return view('errors.404');
//    }]);
//
//    Route::get('500', ['as' => '500', function () {
//        return view('errors.500');
//    }]);
//
//    Route::get('405', ['as' => '405', function () {
//        return view('errors.405');
//    }]);
//
//    Route::get('permissionDeniedScreen', ['as' => 'permissionDeniedScreen', function () {
//        return view('errors.404');
//    }]);
//
//    Route::get('errorChangedApp', ['as' => 'errorChangedApp', function () {
//        return view('errors.404');
//    }]);
//});

Route::group(['prefix' => 'admin', 'middleware' => []], function () {
    Route::get('/', ['as' => 'login', 'uses' => 'AuthController@checkLogin']);

    Route::get('', ['as' => 'login', 'uses' => 'AuthController@checkLogin']);

    Route::get('/login', ['as' => 'loginView', 'uses' => 'AuthController@index']);
});