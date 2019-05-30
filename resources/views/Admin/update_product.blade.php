@extends('layout.admin.main')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý sản phẩm </h3>
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
                        <h2>Quản lý sản phẩm
                            <small>Tạo sản phẩm</small>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <form method="post" data-parsley-validate enctype="multipart/form-data"
                              class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TenSP">Tên sản phẩm
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="TenSP" name="TenSP" required="required"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->product_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Gia">Giá
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="Gia" name="Gia" min="0" required="required"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->price}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="HinhAnh">Hình ảnh
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="HinhAnh" name="HinhAnh"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->image}}">
                                    <p>
                                        <img src="{{$sanpham->image}}" width="100px" alt="">
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GhiChu">Ghi chú
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea rows="7" id="GhiChu" name="GhiChu" required="required"
                                              class="form-control col-md-7 col-xs-12">{{$sanpham->note}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MoTa">Mô tả chi tiết
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea rows="7" id="MoTa" name="MoTa" required="required"
                                              class="form-control col-md-7 col-xs-12">{{$sanpham->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MaDM">Tên danh mục
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="MaDM" class="form-control">
                                        @foreach($danhmuc as $dm)
                                            <option {{ $sanpham->cat_id == $dm->id ? "selected" : '' }} value="{{$dm->id}}">{{$dm->cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NgaySX">Ngày sản xuất
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group col-md-7 col-xs-12" value="{{$sanpham->start_date}}">
                                        <div class='input-group date' id='NgaySX'>
                                            <input type='text' name="NgaySX" class="form-control" required/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MauSac">Màu sắc
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="MauSac" name="MauSac" required="required"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->color}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="KichThuoc">Kích thước
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="KichThuoc" name="KichThuoc" required="required"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->size}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SoLuong">Số lượng
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="SoLuong" name="SoLuong" required="required"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->quantity}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ThoiHanBH">Thời hạn bảo
                                    hành (tháng)
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="ThoiHanBH" name="ThoiHanBH" min="0" required="required"
                                           class="form-control col-md-7 col-xs-12"
                                           value="{{$sanpham->warranty}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ram">RAM
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="ram" name="RAM" required="required"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->RAM}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hdd">Ổ cứng
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="hdd" name="HDD" required="required"
                                           class="form-control col-md-7 col-xs-12" value="{{$sanpham->HDD}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hdd">Sản phẩm
                                </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="SPNew" value="1"> Cũ
                                    </label>
                                    <label>
                                        <input type="radio" name="SPNew" value="0" checked> Mới
                                    </label>
                                </div>
                            </div>
                            @if (isset($error))
                                <div>
                                    <ul>
                                        @foreach ($error as $err)
                                            <li class="text-danger">{{$err}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="{{ route('productList') }}" class="btn btn-primary">Hủy</a>
                                    <button class="btn btn-primary" type="reset">Đặt lại</button>
                                    <button type="submit" class="btn btn-success">Lưu lại</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- bootstrap-datetimepicker -->
    <script src="/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('#NgaySX').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: "{{$sanpham->start_date}}"
        });
    </script>
@endpush