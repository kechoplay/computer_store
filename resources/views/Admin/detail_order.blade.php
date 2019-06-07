@extends('layout.admin.main')

@push('css')
@endpush()

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý hóa đơn</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Chi tiết hóa đơn</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="text-align: center; margin-bottom: 10px;color: red; font-size: 15px;">
                            <span>{{ $errors->first('error') ? $errors->first('error') : '' }}</span>
                        </div>
                        <form method="post" data-parsley-validate enctype="multipart/form-data"
                              class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="TrangThai">Trạng thái
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-6">
                                    @if($hoadon->status == '1')
                                        <b>Chưa xử lí</b>
                                    @elseif($hoadon->status == '2')
                                        <b>Đã xử lý</b>
                                    @elseif($hoadon->status == '3')
                                        <b>Đã giao</b>
                                    @elseif($hoadon->status == '4')
                                        <b>Đã hủy</b>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="HinhThuc">Hình thức thanh
                                    toán
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <b>{{$hoadon->payment_method == 1 ? 'Thanh toán trực tiếp' : 'Chuyển khoản'}} </b>
                                </div>
                            </div>
                            <div class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="TenKH">Tên Khách hàng
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <b>{{$hoadon->customer_name}} </b>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="SDT">Số điện thoại
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <b>{{$hoadon->phone}} </b>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="DiaChi">Địa chỉ
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <b>{{$hoadon->address}} </b>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="GhiChu">Ghi Chú
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <b>{{$hoadon->note}} </b>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DiaChi">Chi tiết đơn
                                        hàng
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <table class="table table-stripped">
                                            <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Giảm</th>
                                                <th>Giá thanh toán</th>
                                                <th>Tổng</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($hoadon->chitiethoadon as $chitiethoadon)
                                                <tr>
                                                    <td>
                                                        {{$chitiethoadon->sanpham->product_name}} <br>
                                                        @if ($chitiethoadon->sanpham->quantity > 0)
                                                            <span>Trong kho còn <b>{{ $chitiethoadon->sanpham->quantity }}</b> sản phẩm</span>
                                                        @else
                                                            <span class="text-danger">Hết hàng</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $chitiethoadon->quantity }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($chitiethoadon->price) }}
                                                    </td>
                                                    <td>
                                                        {{ $chitiethoadon->sale }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($chitiethoadon->price * (1 - $chitiethoadon->sale / 100)) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($chitiethoadon->price * (1 - $chitiethoadon->sale / 100) * $chitiethoadon->quantity) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <b>{{number_format($tongtien)}} </b>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Nội dung in -->

                            <div id="print-area" class="hidden">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="HinhThuc">Hình thức
                                            thanh toán
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <b>{{$hoadon->HinhThuc}} </b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="MaNV">Nhân viên
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <b>{{isset($hoadon->nhanvien) ? $hoadon->nhanvien->TenNV : ' '}} </b>
                                        </div>
                                    </div>
                                <!-- <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="MaKH">Khách hàng
                    <span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <b>{{isset($hoadon->khachhang) ? $hoadon->khachhang->TenKH : ' '}} </b>
                  </div>
                </div> -->
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="TenKH">Tên Khách
                                            hàng
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <b>{{$hoadon->TenKH}} </b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="SDT">Số điện thoại
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <b>{{$hoadon->SDT}} </b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="DiaChi">Địa chỉ
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <b>{{$hoadon->DiaChi}} </b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="GhiChu">Ghi Chú
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <b>{{$hoadon->GhiChu}} </b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DiaChi">Chi tiết
                                            đơn hàng
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Giảm</th>
                                                    <th>Giá thanh toán</th>
                                                    <th>Tổng</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($hoadon->chitiethoadon as $chitiethoadon)
                                                    <tr>
                                                        <td>
                                                            {{ $chitiethoadon->sanpham->product_name }}
                                                        </td>
                                                        <td>
                                                            {{ $chitiethoadon->quantity }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($chitiethoadon->price) }}
                                                        </td>
                                                        <td>
                                                            {{ $chitiethoadon->sale }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($chitiethoadon->price * (1 - $chitiethoadon->sale / 100)) }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($chitiethoadon->price * (1 - $chitiethoadon->sale / 100) * $chitiethoadon->quantity) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <b>{{number_format($tongtien)}} </b>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="{{route('listOrderView')}}" class="btn btn-primary">Quay lại</a>
                                    @if($hoadon->status == 1)
                                        <a href="{{route('approveOrder',['id' => $hoadon->id])}}"
                                           class="btn btn-success">Duyệt</a>
                                        <a href="{{route('cancelOrder',['id' => $hoadon->id])}}" class="btn btn-danger">Hủy</a>
                                    @endif
                                    @if($hoadon->status == 2)
                                        <button type="button" onclick="printDiv('print-area')" class="btn btn-info">In
                                            hóa đơn
                                        </button>
                                        <a href="{{route('listWarrantyView')}}" class="btn btn-primary">Phiếu bảo
                                            hành</a>
                                        <a href="{{route('shipOrder',['id' => $hoadon->id])}}"
                                           class="btn btn-success">Giao hàng</a>
                                        <a href="{{route('cancelShipOrder',['id' => $hoadon->id])}}"
                                           class="btn btn-danger">Hủy</a>
                                    @endif
                                    @if($hoadon->status == 3)
                                        <button type="button" onclick="printDiv('print-area')" class="btn btn-info">In
                                            hóa đơn
                                        </button>
                                        <a href="{{route('listWarrantyView')}}"
                                           class="btn btn-primary">Phiếu bảo hành</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('js')
    <script src="/vendors/jszip/dist/jszip.min.js"></script>
@endpush()