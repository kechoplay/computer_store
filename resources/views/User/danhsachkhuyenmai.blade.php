<?php
$now = time();
?>
@extends('layout.user.main')

@section('content')

    <div class="col-md-9 content_right">
        <h4 class="head"><span class="m_2">Danh sách khuyến mãi</span></h4>
        <div class="top_grid2">
            @foreach($sanpham as $sp)
                @include('layout.wrap_product', ['id' => $sp->sanpham->id, 'image' => $sp->sanpham->image, 'product_name' => $sp->sanpham->product_name, 'price' => $sp->sanpham->price, 'is_sale' => 1])
            @endforeach
            <div class="clearfix"></div>
            {!! $sanpham->links() !!}
        </div>
    </div>

@endsection()