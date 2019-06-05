<?php
$now = time();
?>
@extends('layout.user.main')

@section('content')

    <div class="col-md-9 content_right">
        <h4 class="head"><span class="m_2">Tìm kiếm kết quả cho: </span><span style="text-transform: none">{{ $str }}</span></h4>
        <div class="top_grid2">
            @foreach($sanpham as $sp)
                @if($sp->khuyenmai->count() != 0 && $now >= strtotime($sp->khuyenmai[0]->start_time) && $now <= strtotime($sp->khuyenmai[0]->end_time))
                    @include('layout.wrap_product', ['id' => $sp->id, 'image' => $sp->image, 'product_name' => $sp->product_name, 'price' => $sp->price, 'is_sale' => 1])
                @else
                    @include('layout.wrap_product', ['id' => $sp->id, 'image' => $sp->image, 'product_name' => $sp->product_name, 'price' => $sp->price, 'is_sale' => 0])
                @endif
            @endforeach
            <div class="clearfix"></div>
            {!! $sanpham->links() !!}
        </div>
    </div>

@endsection()