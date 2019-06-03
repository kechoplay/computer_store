@extends('layout.admin.main')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý tin tức</h3>
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
                        <h2>Quản lý tin tức
                            <small>Tạo mới tin tức</small>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        {{ \Illuminate\Support\Facades\Session::get('success') }}
                        <form method="post" data-parsley-validate enctype="multipart/form-data"
                              action="{{ route('storeNewNew') }}" class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TieuDe">Tiêu đề
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="TieuDe" name="TieuDe" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NgayThang">Ngày Đăng
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group col-md-7 col-xs-12">
                                        <div class='input-group date' id='NgayThang'>
                                            <input type='text' name="NgayThang" class="form-control"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="TomTat">Tóm tắt
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="TomTat" name="TomTat" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="HinhAnh">Hình ảnh
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="HinhAnh" name="HinhAnh" required="required" accept="image/*"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NoiDungCT">Nội dung chi
                                    tiết
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="NoiDungCT" name="NoiDungCT" rows="10"></textarea>
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
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script>
        $('#NgayThang').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        CKEDITOR.replace('NoiDungCT');
    </script>
@endpush