@extends('layout.admin.main')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thêm danh muc</h3>
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
                        <h2>Thêm danh muc</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate method="post"
                              action="{{ route('storeNewUser') }}">
                            {{ csrf_field() }}
                            <span class="section">Thông tin danh muc</span>

                            <div style="text-align: center; margin-bottom: 10px;color: red; font-size: 15px;">
                                <span>{{ $errors->first('username') ? $errors->first('username') : '' }}</span>
                                <span>{{ $errors->first('password') ? $errors->first('password') : '' }}</span>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoryName">Tên danh muc
                                    <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="categoryName" class="form-control col-md-7 col-xs-12" name="cateName"
                                           placeholder="" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="parentId" class="control-label col-md-3">Danh muc cha <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="parentId" name="parentId" class="form-control col-md-7 col-xs-12">
                                        @foreach($danhmucha as $danhmuc)
                                            <option {{ $danhmuc['id'] }}>{{ $danhmuc['cate_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Nhập lại mật
                                    khẩu
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password2" type="password" name="password2"
                                           data-validate-linked="password" class="form-control col-md-7 col-xs-12"
                                           required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Tên đầy đủ
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="fullname" name="fullname"
                                           class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="genderM">Giới tính <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    Nam:
                                    <input type="radio" class="flat" name="gender" id="genderM" value="1" checked
                                           required/>
                                    Nữ:
                                    <input type="radio" class="flat" name="gender" id="genderF" value="2"/>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>
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
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
@endpush