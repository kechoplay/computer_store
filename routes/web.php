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

Route::group(['prefix' => 'admin', 'middleware' => ['admin_access']], function () {
    Route::get('/index', ['as' => 'adminIndex', 'uses' => 'AdminController@index']);

    Route::post('/update-profile', ['as' => 'updateProfile', 'uses' => 'AdminController@storeProfile']);

    Route::get('/list-user', ['as' => 'listUserView', 'uses' => 'AdminController@listUser'])->middleware('admin_access');

    Route::get('/add-new-user', ['as' => 'addNewUserView', 'uses' => 'AdminController@addNewUserView'])->middleware('admin_access');

    Route::post('/store-new-user', ['as' => 'storeNewUser', 'uses' => 'AdminController@storeNewUser'])->middleware('admin_access');

    Route::get('/delete-user/{id}', ['as' => 'deleteUser', 'uses' => 'AdminController@deleteUser']);
});

Route::get('/admin/', ['as' => 'login', 'uses' => 'AuthController@checkLogin']);

Route::get('/admin', ['as' => 'login', 'uses' => 'AuthController@checkLogin']);

Route::get('/admin/login', ['as' => 'loginView', 'uses' => 'AuthController@index']);

Route::post('/admin/login', ['as' => 'postLogin', 'uses' => 'AuthController@login']);

Route::get('/admin/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);