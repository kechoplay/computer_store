<?php
$now = time();
$totalPrice = 0;
?>
@extends('layout.user.main')

@push('css')
    <link rel="stylesheet" href="/css/giohang.css?time={{ $now }}">
    <style>
        p {
            text-align: center;
            font-size: 21px;
        }
    </style>
@endpush
@section('content')

    <div class="giohang">
        <div class="row content-giohang">
            <div class="col-md-3">
                <a href="{{ route('index') }}" style="color:blue;">
                    <i class="fa fa-chevron-left"></i> Mua thêm sản phẩm khác
                </a>
            </div>
            <div class="main-giohang col-md-6">
                <div class="col-md-12">
                    <p>Giỏ hàng của bạn</p>
                </div>
                <div class="row col-md-12">
                    @if(sizeof($listProduct))
                        <form action="{{ route('updateCart') }}" method="POST">
                            {{ csrf_field() }}
                            @foreach($listProduct as $product)
                                <?php $totalPrice += $product['price'] * $product['quantity'] ?>
                                <div class="row sp-giohang">
                                    <div class="col-md-3">
                                        <img src="{{ $product['image']}}" alt="">
                                        <a href="{{ route('deleteCart', ['id' => $product['id']]) }}">
                                            <i class="fa fa-times">Xoá</i>
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <a href="{{ route('chitietsanpham', ['id' => $product['id']]) }}">
                                            <h3>{{ $product['product_name'] }}</h3>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($product['sale'] != 0)
                                            <h4 class="text-muted">
                                                <del>{{ number_format($product['price_origin']) }}</del>
                                                <small>-{{ $product['sale'] }}%</small>
                                            </h4>
                                        @endif
                                        <h4>{{ number_format($product['price']) }}</h4>
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6 soluong-sp">
                                            <!--quantity-->
                                            <div style="margin-bottom:2em;text-align:center;">
                                                <div class="change_qty minus cursor_hover">&#45;</div>
                                                <input name="quantity[]" type="number"
                                                       style="height:35px;width:40px;margin:0 .5em;text-align:center;"
                                                       value="{{ $product['quantity']}}">
                                                <div class="change_qty plus cursor_hover">&#43;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Cập nhật giỏ hàng
                            </button>
                        </form>
                        <script>
                            $(function () {
                                $(".plus").click(function (e) {
                                    e.preventDefault();
                                    var $this = $(this);
                                    var $input = $this.siblings('input');
                                    var value = parseInt($input.val());

                                    if (value < 30) {
                                        value = value + 1;
                                    } else {
                                        value = 30;
                                    }

                                    $input.val(value);
                                });

                                $(".minus").click(function (e) {
                                    e.preventDefault();
                                    var $this = $(this);
                                    var $input = $this.siblings('input');
                                    var value = parseInt($input.val());

                                    if (value > 1) {
                                        value = value - 1;
                                    } else {
                                        value = 1;
                                    }

                                    $input.val(value);
                                });
                            });
                        </script>
                        <hr>
                        <div class="row tongtien">
                            <div class="col-md-6">
                                <b>Tổng tiền: </b>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h4>{{number_format($totalPrice)}} đ</h4>
                            </div>
                        </div>
                        <hr>
                        @if(\Illuminate\Support\Facades\Auth::guard('users')->check())
                            <div class="from_TTKH">
                                <form action="{{ route('checkout') }}">
                                    <div class="row from_TT">
                                        <div class="col-md-12">
                                            <label>Họ tên</label>
                                            <input type="text" name="TenKH" class="form-control" placeholder="Họ và tên"
                                                   required
                                                   value="{{ \Illuminate\Support\Facades\Auth::guard('users')->user()->name }}">
                                        </div>
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="SDT" class="form-control"
                                                   placeholder="Số điện thoại" required
                                                   value="{{ \Illuminate\Support\Facades\Auth::guard('users')->user()->phone }}">
                                        </div>
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label>Email</label>
                                            <input type="email" name="Email" class="form-control"
                                                   placeholder="Email (Để theo dõi quá trình nhận hàng)" required
                                                   value="{{ \Illuminate\Support\Facades\Auth::guard('users')->user()->email }}">
                                        </div>
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label>Địa chỉ nhận hàng</label>
                                            <textarea rows="5" name="DiaChi" class="form-control" required>
                                                {{ \Illuminate\Support\Facades\Auth::guard('users')->user()->address }}
                                            </textarea>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label>Ghi chú</label>
                                            <textarea rows="5" name="GhiChu" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row choosepayment">
                                        <a href="" class="payoffline col-md-6">
                                            <button type="submit" name="HinhThuc" value="1"
                                                    class="btn btn-primary">
                                                thanh toán khi nhận hàng
                                                <br>
                                                <span>Xem hàng trước</span>
                                            </button>
                                        </a>
                                        <a href="" class="payonline col-md-6">
                                            <button type="submit" name="HinhThuc" value="2"
                                                    class="btn btn-primary">thanh toán online
                                                <br>
                                                <span>Dùng thẻ ATM (có internet Banking)</span>
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        @else
                            <p>Bạn hãy đăng nhập để mua hàng</p>
                        @endif
                    @else
                        <div>
                            <h3>Bạn chưa có sản phẩm nào trong giỏ hàng</h3>
                            <a href="{{ route('index') }}">Tiếp tục mua sắm</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection()