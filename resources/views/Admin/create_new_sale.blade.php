@extends('layout.admin.main')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý khuyến mại</h3>
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
                        <h2>Quản lý khuyến mại
                            <small>Tạo mới khuyến mại</small>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        {{ \Illuminate\Support\Facades\Session::get('success') }}
                        <form method="post" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('storeNewSale') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ThoiGianBD">Thời gian bắt
                                    đầu
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group col-md-7 col-xs-12">
                                        <div class='input-group date' id='ThoiGianBD'>
                                            <input type='text' name="ThoiGianBD" class="form-control" required/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ThoiGianKT">Thời gian kết
                                    thúc
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group col-md-7 col-xs-12">
                                        <div class='input-group date' id='ThoiGianKT'>
                                            <input type='text' name="ThoiGianKT" class="form-control" required/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Giam">Giảm
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="number" min="0" id="Giam" name="Giam" required
                                               class="form-control col-md-7 col-xs-12">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MaSP">Sản phẩm
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="MaSP" name="MaSP">
                                        @foreach($danhsachsanpham as $sanpham)
                                            <option value="{{$sanpham->id}}">{{$sanpham->product_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="reset">Đặt lại</button>
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
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
        $('#ThoiGianBD').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#ThoiGianKT').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    </script>
@endpush