<?php
$now = time();
$totalPrice = 0;
?>
@extends('layout.user.main')

@push('css')
    <link rel="stylesheet" href="/css/thanhtoan.css?time={{ $now }}">
    <style>

    </style>
@endpush
@section('content')

    <div class="thanhtoan">
        <div class="from_thongbao">
            <div class="from_DHTC">
                @if (isset($listProduct))
                    <span><i class="fa fa-check"></i> đặt hàng thành công</span>
                    <p class="camon"> Cảm ơn quý khách đã cho chúng tôi cơ hội được phục vụ. Trong vòng 5 phút sẽ có
                        nhân viên gửi tin nhắn hoặc gọi điện xác nhận giao hàng cho anh.
                    </p>
                    <div class="from_DH">
                        <h4>thông tin đặt hàng</h4>
                        <ul>
                            <li>Mã hóa đơn: <b>{{ $hoaDon->id }}</b></li>
                            <li>Địa chỉ nhận hàng: <b>{{ $hoaDon->address }}</b></li>
                            <li>Tổng tiền: <b>{{ number_format($totalMoney) }} VNĐ</b></li>
                            @if (isset($hoaDon->hinhthucthanhtoan->payment_name))
                                <li>{{ $hoaDon->hinhthucthanhtoan->payment_name }}</li>
                            @endif
                        </ul>
                        <p>Trước khi giao hàng nhân viên sẽ gọi quý khách để xác nhận. Khi cần hỗ trợ vui lòng liên hệ
                            <span>0977.508.881</span> (7h30-22h).
                        </p>
                    </div>
                    @if($hoaDon->payment_method != '1')
                        <div class="from_DH">
                            <h4>Thanh toán online</h4>
                            <p>Đối với hình thức thanh toán online. Quý khách vui lòng thanh toán bằng cách chuyển khoản
                                qua
                                một trong các tài khoản sau</p>
                            <ul>
                                <li>
                                    Tài khoản Techcombank - Chi nhánh Hoàng Quốc Việt <br>
                                    Số tài khoản: 19031190265017 <br>
                                    Tên chủ tài khoản: Nguyễn Thị A
                                </li>
                            </ul>
                            <p>
                                Nội dung chuyển khoản ghi:
                                <b>Thanh toán hóa đơn {{ $hoaDon->id }}</b>
                            </p>
                        </div>
                    @endif
                    <div class="from_DH">
                        <h4>sản phẩm đã mua</h4>
                        @foreach ($listProduct as $key => $cart)
                            <div class="row from_SP">
                                <div class="col-md-3">
                                    <a href="{{ route('chitietsanpham', ['id' => $key]) }}"><img src="{{ $cart['image'] }}" alt=""></a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{ route('chitietsanpham', ['id' => $key]) }}"><h5>{{ $cart['product_name'] }}</h5></a>
                                </div>
                                <div class="col-md-2">
                                    @if ($cart['sale'] != 0)
                                        <h5>
                                            <del>{{ number_format($cart['price_origin']) }} đ</del>
                                            <br>
                                            <small>-{{ $cart['sale'] }} %</small>
                                        </h5>
                                    @endif
                                    <h5>{{ number_format($cart['price']) }} đ</h5>
                                    <h6>Số lượng:
                                        <i>{{ $cart['quantity'] }}</i>
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                        <div class="from_DH">
                            <hr>
                            <a href="{{route('index')}}" class="muathem">
                                <button type="button" class="btn btn-primary">mua thêm sản phẩm khác</button>
                            </a>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection()