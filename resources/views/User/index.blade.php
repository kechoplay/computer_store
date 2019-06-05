<?php
$now = time();
?>
@extends('layout.user.main')

@section('content')

    <div class="col-md-9 content_right">
        <h4 class="head"><span class="m_2">Sản phẩm mới nhất</span></h4>
        <div class="top_grid2">
            @foreach($sanphamnew as $new)
                @if($new->khuyenmai->count() != 0 && $now >= strtotime($new->khuyenmai[0]->start_time) && $now <= strtotime($new->khuyenmai[0]->end_time))
                    @include('layout.wrap_product', ['id' => $new->id, 'image' => $new->image, 'product_name' => $new->product_name, 'price' => $new->price, 'is_sale' => 1])
                @else
                    @include('layout.wrap_product', ['id' => $new->id, 'image' => $new->image, 'product_name' => $new->product_name, 'price' => $new->price, 'is_sale' => 0])
                @endif
            @endforeach
            <div class="clearfix"></div>
        </div>

        <h4 class="head"><span class="m_2">Sản phẩm khuyễn mãi</span></h4>
        <div class="top_grid2">
            @foreach($danhsachkhuyenmai as $new)
                @include('layout.wrap_product', ['id' => $new->sanpham->id, 'image' => $new->sanpham->image, 'product_name' => $new->sanpham->product_name, 'price' => $new->sanpham->price, 'is_sale' => 1])
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>

@endsection()