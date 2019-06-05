<?php
$now = time();
?>
@extends('layout.user.main')
@section('content')

    <div class="col-md-9 single_right">
        <div class="single_top">
            <div class="single_grid">
                <div class="grid images_3_of_2">
                    <ul id="etalage" class="etalage" style="display: block; width: 300px; height: 533px;">
                        <li class="etalage_thumb thumb_3 etalage_thumb_active"
                            style="background-image: none; display: list-item; opacity: 1;">
                            <img class="etalage_thumb_image" src="{{ $sanpham->image }}"
                                 style="display: inline; width: 300px; height: 400px; opacity: 1;">
                            <img class="etalage_source_image" src="{{ $sanpham->image }}">
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="desc1 span_3_of_2">
                    <h1> {{ $sanpham->product_name }}</h1>
                    <p class="availability">Tình trạng: <span
                                class="color">{{ ($sanpham->quantity > 0) ? 'Còn hàng' : 'Hết hàng'}}</span></p>
                    <div class="price_single">
                        @if($sanpham->khuyenmai->count() != 0 && $now >= strtotime($sanpham->khuyenmai[0]->start_time) && $now <= strtotime($sanpham->khuyenmai[0]->end_time))
                            <span class="reducedfrom">{{ number_format($sanpham->price) }}</span>
                            <span class="actual">{{ number_format($sanpham->price - ($sanpham->price * $khuyenmai->sale / 100)) }}</span>
                        @else
                            <span class="actual">{{ number_format($sanpham->price) }}</span>
                        @endif
                    </div>
                    <form method="get" action="{{ route('addCart', ['id' => $sanpham->id]) }}">
                        <div class="quantity_box">
                            <ul class="product-qty">
                                <span>Số lượng:</span>
                                <input type="number" id="quantity" name="quantity" min="0"
                                       max="{{ $sanpham->quantity }}" value="{{ $sanpham->quantity }}">
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <button type="submit" class="btn bt1 btn-primary btn-normal btn-inline ">
                            Mua
                        </button>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="sap_tabs">
            <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                <ul class="resp-tabs-list">
                    <li class="resp-tab-item resp-tab-active" aria-controls="tab_item-0" role="tab"><span>Miêu tả</span>
                    </li>
                    <div class="clear"></div>
                </ul>
                <div class="resp-tabs-container">
                    <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0">
                        <span class="resp-arrow"></span>Miêu tả
                    </h2>
                    <div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0"
                         style="display:block">
                        <div class="facts">
                            <ul class="tab_list">
                                <li>{{ $sanpham->description }}</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <h3 class="single_head">Sản phẩm liên quan</h3>
        <div class="related_products">
            @foreach($sanphamcungloai as $same)
                <div class="col-md-4 top_grid1-box1">
                    <div class="grid_1">
                        <a href="{{ route('chitietsanpham', ['id' => $same->id]) }}">
                            <div class="b-link-stroke b-animate-go  thickbox">
                                <img src="{{ $same->image }}" class="img-responsive" alt=""
                                     style="width: 100%; height: 300px">
                            </div>
                        </a>
                        <div class="grid_2" style="height: 100px;">
                            <a href="{{ route('chitietsanpham', ['id' => $same->id]) }}">
                                <p>{{ $same->product_name }}</p></a>
                            <ul class="grid_2-bottom">
                                <li class="grid_2-left">
                                    <p>{{ number_format($same->price) }}</p>
                                </li>
                                <li class="grid_2-right">
                                    <div class="btn btn-primary btn-normal btn-inline " target="_self"
                                         title="Get It">
                                        Mua
                                    </div>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>

@endsection()