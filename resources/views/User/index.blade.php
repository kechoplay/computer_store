<?php
$now = time();
?>
@extends('layout.user.main')

@section('content')

    <div class="col-md-10 content_right">
        @if(count($sanphamnew) > 0)
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
        @endif

        @if(count($danhsachkhuyenmai) > 0)
            <h4 class="head"><span class="m_2">Sản phẩm khuyễn mãi</span></h4>
            <div class="top_grid2">
                @foreach($danhsachkhuyenmai as $new)
                    @include('layout.wrap_product', ['id' => $new->sanpham->id, 'image' => $new->sanpham->image, 'product_name' => $new->sanpham->product_name, 'price' => $new->sanpham->price, 'is_sale' => 1])
                @endforeach
                <div class="clearfix"></div>
            </div>
        @endif

        <h4 class="head"><span class="m_2">Danh sách sản phẩm</span></h4>
        <div class="top_grid2">
            @foreach($danhsachsanpham as $ds)
                @if($ds->khuyenmai->count() != 0 && $now >= strtotime($ds->khuyenmai[0]->start_time) && $now <= strtotime($ds->khuyenmai[0]->end_time))
                    @include('layout.wrap_product', ['id' => $ds->id, 'image' => $ds->image, 'product_name' => $ds->product_name, 'price' => $ds->price, 'is_sale' => 1])
                @else
                    @include('layout.wrap_product', ['id' => $ds->id, 'image' => $ds->image, 'product_name' => $ds->product_name, 'price' => $ds->price, 'is_sale' => 0])
                @endif
            @endforeach
            <div class="clearfix"></div>
        </div>
        <div class="top_grid2" style="text-align: center">
            <a href="{{ route('danhsachsanpham') }}" class="load-more">Xem thêm </a>
        </div>
    </div>

@endsection()