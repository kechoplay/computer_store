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