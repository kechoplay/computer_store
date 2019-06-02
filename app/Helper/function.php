<?php

function getDanhMuc()
{
    $danhmuc = \App\DanhMuc::where('cat_status', 1)->where('parent_id', 0)->orderBy('sort_order', 'ASC')->get();

    return $danhmuc;
}