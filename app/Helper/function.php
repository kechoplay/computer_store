<?php

function getDanhMuc()
{
    $danhmuc = \App\DanhMuc::where('cat_status', 1)->where('parent_id', 0)->orderBy('sort_order', 'ASC')->get();

    return $danhmuc;
}

function checkSale($idProduct)
{
    $khuyenmai = \App\KhuyenMai::where('product_id', $idProduct)->first();

    return $khuyenmai;
}

function getTinTuc()
{
    $tintuc = \App\TinTuc::take(5)->get();

    return $tintuc;
}

function getShoppingCart()
{
    $listCart = \Illuminate\Support\Facades\Session::get('cart');
    return $listCart;
}