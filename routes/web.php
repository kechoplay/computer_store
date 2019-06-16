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

// route /admin/
Route::group(['prefix' => 'admin', 'middleware' => ['admin_access']], function () {
    Route::get('/index', ['as' => 'adminIndex', 'uses' => 'AdminController@index']);

    Route::get('/', ['as' => 'adminIndex', 'uses' => 'AdminController@index']);

    Route::get('', ['as' => 'adminIndex', 'uses' => 'AdminController@index']);

    Route::post('/update-profile', ['as' => 'updateProfile', 'uses' => 'AdminController@storeProfile']);
// admin
    Route::get('/list-user', ['as' => 'listUserView', 'uses' => 'AdminController@listUser'])->middleware('super_admin');

    Route::get('/add-new-user', ['as' => 'addNewUserView', 'uses' => 'AdminController@addNewUserView'])->middleware('super_admin');

    Route::post('/store-new-user', ['as' => 'storeNewUser', 'uses' => 'AdminController@storeNewUser'])->middleware('super_admin');

    Route::get('/delete-user/{id}', ['as' => 'deleteUser', 'uses' => 'AdminController@deleteUser'])->middleware('super_admin');
// danh muc
    Route::get('/list-category', ['as' => 'listCategoryView', 'uses' => 'DanhMucController@listCategory']);

    Route::get('/add-new-category', ['as' => 'addNewCategoryView', 'uses' => 'DanhMucController@addNewCategory']);

    Route::post('/store-new-category', ['as' => 'storeNewCategory', 'uses' => 'DanhMucController@storeNewCategory']);

    Route::get('/update-category/{id}', ['as' => 'updateCategoryView', 'uses' => 'DanhMucController@updateCategory']);

    Route::post('/edit-category', ['as' => 'editCategory', 'uses' => 'DanhMucController@editCategory']);

    Route::get('/delete-category/{id}', ['as' => 'deleteCategory', 'uses' => 'DanhMucController@deleteCategory']);
// san pham
    Route::get('/list-product', ['as' => 'productList', 'uses' => 'SanPhamController@index']);

    Route::get('/create-new-product', ['as' => 'createProductView', 'uses' => 'SanPhamController@createProduct']);

    Route::post('/store-new-product', ['as' => 'storeNewProduct', 'uses' => 'SanPhamController@storeNewProduct']);

    Route::get('/edit-product/{id}', ['as' => 'editProductView', 'uses' => 'SanPhamController@editProduct']);

    Route::post('/edit-product/{id}', ['as' => 'editProduct', 'uses' => 'SanPhamController@update']);
// khuyen mai
    Route::get('/sale-list', ['as' => 'saleListView', 'uses' => 'KhuyenMaiController@index']);

    route::get('create-new-sale', ['as' => 'createNewSaleView', 'uses' => 'KhuyenMaiController@create']);

    route::post('store-new-sale', ['as' => 'storeNewSale', 'uses' => 'KhuyenMaiController@store']);

    Route::get('/update-sale/{id}', ['as' => 'updateSaleView', 'uses' => 'KhuyenMaiController@update']);

    Route::post('/update-sale/{id}', ['as' => 'updateSale', 'uses' => 'KhuyenMaiController@edit']);

    Route::get('/delete-sale/{id}', ['as' => 'deleteSale', 'uses' => 'KhuyenMaiController@delete']);
// tin tuc
    Route::get('/list-news', ['as' => 'listNewView', 'uses' => 'TinTucController@index']);

    route::get('create-new-news', ['as' => 'createNewNewView', 'uses' => 'TinTucController@create']);

    route::post('store-new-news', ['as' => 'storeNewNew', 'uses' => 'TinTucController@store']);

    Route::get('/update-new/{id}', ['as' => 'updateNewView', 'uses' => 'TinTucController@update']);

    Route::post('/update-new/{id}', ['as' => 'updateNew', 'uses' => 'TinTucController@edit']);

    Route::get('/delete-new/{id}', ['as' => 'deleteNew', 'uses' => 'TinTucController@delete']);
// hoa don
    Route::get('/list-orders', ['as' => 'listOrderView', 'uses' => 'HoaDonController@index']);

    Route::get('/order-detail/{id}', ['as' => 'orderDetailView', 'uses' => 'HoaDonController@orderDetail']);

    Route::get('/order/approve/{id}', ['as' => 'approveOrder', 'uses' => 'HoaDonController@approve']);

    Route::get('/order/cancel/{id}', ['as' => 'cancelOrder', 'uses' => 'HoaDonController@cancel']);

    Route::get('/order/ship/{id}', ['as' => 'shipOrder', 'uses' => 'HoaDonController@ship']);

    Route::get('/order/cancel-ship/{id}', ['as' => 'cancelShipOrder', 'uses' => 'HoaDonController@cancelShip']);
// phiếu bảo hành
    Route::get('/warranty', ['as' => 'listWarrantyView', 'uses' => 'PhieuBaoHanhController@index']);
// thống kê
    Route::get('/statistic', ['as' => 'statistic', 'uses' => 'AdminController@statistic']);

    Route::get('/statistic/product', ['as' => 'statisticProduct', 'uses' => 'AdminController@statisticProduct']);
//  nhà cung cấp
    Route::get('/list-supplier', ['as' => 'listSupplierView', 'uses' => 'NhaCungCapController@index']);

    Route::get('/add-new-supplier', ['as' => 'addNewSupplierView', 'uses' => 'NhaCungCapController@create']);

    Route::post('/store-new-supplier', ['as' => 'storeNewSupplier', 'uses' => 'NhaCungCapController@store']);

    Route::get('/update-supplier/{id}', ['as' => 'updateSupplierView', 'uses' => 'NhaCungCapController@update']);

    Route::post('/edit-supplier', ['as' => 'editSupplier', 'uses' => 'NhaCungCapController@edit']);

    Route::get('/delete-supplier/{id}', ['as' => 'deleteSupplier', 'uses' => 'NhaCungCapController@delete']);
//  nhà cung cấp
    Route::get('/list-payment', ['as' => 'listPaymentView', 'uses' => 'HinhThucThanhToanController@index']);

    Route::get('/add-new-payment', ['as' => 'addNewPaymentView', 'uses' => 'HinhThucThanhToanController@create']);

    Route::post('/store-new-payment', ['as' => 'storeNewPayment', 'uses' => 'HinhThucThanhToanController@store']);

    Route::get('/update-payment/{id}', ['as' => 'updatePaymentView', 'uses' => 'HinhThucThanhToanController@update']);

    Route::post('/edit-payment', ['as' => 'editPayment', 'uses' => 'HinhThucThanhToanController@edit']);

    Route::get('/delete-payment/{id}', ['as' => 'deletePayment', 'uses' => 'HinhThucThanhToanController@delete']);
});

Route::get('/admin/login', ['as' => 'loginView', 'uses' => 'AuthController@index']);

Route::post('/admin/login', ['as' => 'postLogin', 'uses' => 'AuthController@login']);

Route::get('/admin/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

// route user
Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

Route::get('/san-pham/chi-tiet-san-pham/{id}', ['as' => 'chitietsanpham', 'uses' => 'SanPhamController@chiTietSanPham']);

Route::get('/san-pham/danh-sach-san-pham', ['as' => 'danhsachsanpham', 'uses' => 'SanPhamController@danhSachSanPham']);

Route::get('/san-pham/danh-sach-khuyen-mai', ['as' => 'danhsachkhuyenmai', 'uses' => 'SanPhamController@danhSachKhuyenMai']);

Route::get('/san-pham/tim-kiem', ['as' => 'searchProduct', 'uses' => 'SanPhamController@searchProduct']);

Route::get('/san-pham/danh-muc/{id}', ['as' => 'productCategory', 'uses' => 'SanPhamController@productCategory']);

Route::get('/tin-tuc', ['as' => 'danhsachtintuc', 'uses' => 'TinTucController@listNew']);

Route::get('/tin-tuc/{id}', ['as' => 'chitiettintuc', 'uses' => 'TinTucController@detailNew']);

Route::get('/gio-hang/add-cart/{id}', ['as' => 'addCart', 'uses' => 'ShoppingCartController@addCart']);

Route::post('/gio-hang/update-cart', ['as' => 'updateCart', 'uses' => 'ShoppingCartController@updateCart']);

Route::get('/gio-hang/delete-cart/{id}', ['as' => 'deleteCart', 'uses' => 'ShoppingCartController@deleteCart']);

Route::get('/gio-hang', ['as' => 'cart', 'uses' => 'ShoppingCartController@cart']);

Route::get('/login', ['as' => 'loginUserView', 'uses' => 'UserController@loginForm']);

Route::post('/login', ['as' => 'postUserLogin', 'uses' => 'UserController@login']);

Route::get('/register', ['as' => 'registerView', 'uses' => 'UserController@registerForm']);

Route::post('/register', ['as' => 'postRegister', 'uses' => 'UserController@register']);

Route::get('/gio-hang/thanh-toan', ['as' => 'checkout', 'uses' => 'ShoppingCartController@checkout'])->middleware('check_login_user');

Route::get('/logout', ['as' => 'logoutUser', 'uses' => 'UserController@logout']);
