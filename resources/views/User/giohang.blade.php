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
                        @if(Session::get('dangnhap'))
                            <div class="from_TTKH">
                                <form action="{{route('dathang.thanhtoan')}}">
                                    <div class="row from_TT">
                                        <div class="col-md-6">
                                            <input type="text" name="TenKH" class="form-control" placeholder="Họ và tên"
                                                   value="{{Session::get('dangnhap')->TenKH}}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="SDT" class="form-control"
                                                   placeholder="Số điện thoại"
                                                   value="{{Session::get('dangnhap')->SDT}}" required>
                                        </div>
                                        <div class="col" style="margin-top: 15px;">
                                            <input type="text" name="Email" class="form-control" placeholder="Email"
                                                   value="{{Session::get('dangnhap')->Email}}" required>
                                        </div>
                                    </div>
                                    <b style="margin-left: 20px;">Để được phục vụ nhanh hơn,
                                        <a href="" class="hover_fromDC"> hãy chọn thêm</a> :</b>
                                    <div class="row from_DC">
                                        <div class="btn-group col-md-6">
                                            <select class="form-control" name="thanhpho"
                                                    placeholder="Chọn tỉnh, thành phố"
                                                    id="">
                                                <option value="Hà Nội">Hà Nội</option>
                                                <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                                <option value="Bắc Ninh">Bắc Ninh</option>
                                                <option value="Bắc Giang">Bắc Giang</option>
                                                <option value="Thanh Hóa">Thanh Hóa</option>
                                                <option value="Ninh Bình">Ninh Bình</option>
                                            </select>
                                        </div>
                                        <input class="form-control col-md-12" style="margin-bottom: 10px;" type="text"
                                               name="DiaChi" placeholder="Số nhà, tên đường, phường/xã"
                                               value="{{Session::get('dangnhap')->DiaChi}}" required>
                                        <!-- <h6>Thời gian giao:</h6>
                                        <input class="form-control col-md-6" type="text" placeholder="Hôm nay + date"> -->
                                        <input class="form-control col-md-12" style="margin-top: 10px;" type="text"
                                               name="GhiChu" placeholder="Yêu cầu khác (không bắt buộc)">
                                    </div>
                                    <div class="row choosepayment">
                                        <a href="" class="payoffline col-md-6">
                                            <button type="submit" name="HinhThuc" value="GiaoHang"
                                                    class="btn btn-primary">
                                                thanh toán khi nhận hàng
                                                <br>
                                                <span>Xem hàng trước</span>
                                            </button>
                                        </a>
                                        <a href="" class="payonline col-md-6">
                                            <button type="submit" name="HinhThuc" value="ChuyenKhoan"
                                                    class="btn btn-danger">thanh toán online
                                                <br>
                                                <span>Dùng thẻ ATM (có internet Banking)</span>
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="from_TTKH">
                                <form action="{{ route('checkout') }}">
                                    <div class="row from_TT">
                                        <div class="col-md-6">
                                            <input type="text" name="TenKH" class="form-control" placeholder="Họ và tên"
                                                   required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="SDT" class="form-control"
                                                   placeholder="Số điện thoại"
                                                   required>
                                        </div>
                                        <div class="col" style="margin-top: 15px;">
                                            <input type="text" name="Email" class="form-control"
                                                   placeholder="Email (Để theo dõi quá trình nhận hàng)" required>
                                        </div>
                                    </div>
                                    <b style="margin-left: 20px;">Để được phục vụ nhanh hơn,
                                        <a href="" class="hover_fromDC"> hãy chọn thêm</a> :</b>
                                    <div class="row from_DC">
                                        <div class="btn-group col-md-6">
                                            <select class="form-control" name="thanhpho"
                                                    placeholder="Chọn tỉnh, thành phố"
                                                    id="">
                                                <option value="Hà Nội">Hà Nội</option>
                                                <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                                <option value="Bắc Ninh">Bắc Ninh</option>
                                                <option value="Bắc Giang">Bắc Giang</option>
                                                <option value="Thanh Hóa">Thanh Hóa</option>
                                                <option value="Ninh Bình">Ninh Bình</option>
                                            </select>
                                        </div>
                                        <!-- <div class="btn-group col-md-6">
                                            <select class="form-control" name="quanhuyen" placeholder="Chọn quận, huyện" id="">
                                                <option value="Hà Nội">Hà Nội</option>
                                                <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                                <option value="Bắc Ninh">Bắc Ninh</option>
                                                <option value="Bắc Giang">Bắc Giang</option>
                                                <option value="Thanh Hóa">Thanh Hóa</option>
                                                <option value="Ninh Bình">Ninh Bình</option>
                                            </select>
                                        </div> -->
                                        <input class="form-control col-md-12" style="margin-bottom: 10px;" type="text"
                                               name="DiaChi" placeholder="Số nhà, tên đường, phường/xã" required>
                                        <!-- <h6>Thời gian giao:</h6>
                                        <input class="form-control col-md-6" type="text" placeholder="Hôm nay + date"> -->
                                        <input class="form-control col-md-12" style="margin-top: 10px;" type="text"
                                               name="GhiChu" placeholder="Yêu cầu khác (không bắt buộc)">
                                    </div>
                                    <div class="row choosepayment">
                                        <a href="" class="payoffline col-md-6">
                                            <button type="submit" name="HinhThuc" value="GiaoHang"
                                                    class="btn btn-primary">
                                                thanh toán khi nhận hàng
                                                <br>
                                                <span>Xem hàng trước</span>
                                            </button>
                                        </a>
                                        <a href="" class="payonline col-md-6">
                                            <button type="submit" name="HinhThuc" value="ChuyenKhoan"
                                                    class="btn btn-danger">thanh toán online
                                                <br>
                                                <span>Dùng thẻ ATM (có internet Banking)</span>
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>
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