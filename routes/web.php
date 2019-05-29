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

    Route::get('/', ['as' => 'adminIndex', 'uses' => 'AdminController@index']);

    Route::get('', ['as' => 'adminIndex', 'uses' => 'AdminController@index']);

    Route::post('/update-profile', ['as' => 'updateProfile', 'uses' => 'AdminController@storeProfile']);

    Route::get('/list-user', ['as' => 'listUserView', 'uses' => 'AdminController@listUser'])->middleware('super_admin');

    Route::get('/add-new-user', ['as' => 'addNewUserView', 'uses' => 'AdminController@addNewUserView'])->middleware('super_admin');

    Route::post('/store-new-user', ['as' => 'storeNewUser', 'uses' => 'AdminController@storeNewUser'])->middleware('super_admin');

    Route::get('/delete-user/{id}', ['as' => 'deleteUser', 'uses' => 'AdminController@deleteUser'])->middleware('super_admin');

    Route::get('/list-category', ['as' => 'listCategoryView', 'uses' => 'DanhMucController@listCategory']);

    Route::get('/add-new-category', ['as' => 'addNewCategoryView', 'uses' => 'DanhMucController@addNewCategory']);

    Route::post('/store-new-category', ['as' => 'storeNewCategory', 'uses' => 'DanhMucController@storeNewCategory']);

    Route::get('/update-category/{id}', ['as' => 'updateCategoryView', 'uses' => 'DanhMucController@updateCategory']);

    Route::post('/edit-category', ['as' => 'editCategory', 'uses' => 'DanhMucController@editCategory']);

    Route::get('/delete-category/{id}', ['as' => 'deleteCategory', 'uses' => 'DanhMucController@deleteCategory']);

    Route::get('/list-product', ['as' => 'productList', 'uses' => 'SanPhamController@index']);

    Route::get('create-new-product', ['as' => 'createProductView', 'uses' => 'SanPhamController@createProduct']);

    Route::post('store-new-product', ['as' => 'storeNewProduct', 'uses' => 'SanPhamController@storeNewProduct']);

    Route::get('update/{MaSP}', ['as' => 'quanlysanpham.update', 'uses' => 'SanPhamController@update']);

    Route::post('update/{MaSP}', ['as' => 'quanlysanpham.sua', 'uses' => 'SanPhamController@sua']);
});

Route::get('/admin/login', ['as' => 'loginView', 'uses' => 'AuthController@index']);

Route::post('/admin/login', ['as' => 'postLogin', 'uses' => 'AuthController@login']);

Route::get('/admin/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);