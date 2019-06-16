@extends('layout.admin.main')

@push('css')
    <style>
        .required {
            color: red;
        }
    </style>
@endpush
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Sửa nhà cung cấp</h3>
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
                        <h2>Thông tin nhà cung cấp</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate method="post"
                              action="{{ route('editSupplier') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $nhacungcap->id }}">

                            <div style="text-align: center; margin-bottom: 10px;color: red; font-size: 15px;">
                                <span>{{ $errors->first('error') ? $errors->first('error') : '' }}</span>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supply_name">Tên nhà cung
                                    cấp
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="supply_name" class="form-control col-md-7 col-xs-12" name="supply_name"
                                           required="required" type="text" value="{{ old('supply_name') ? old('supply_name') : $nhacungcap->supply_name }}">
                                    @if($errors->has('supply_name'))
                                        <span class="required">{{ $errors->first('supply_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supply_address">Địa chỉ
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="supply_address" class="form-control col-md-7 col-xs-12"
                                           name="supply_address" required="required" type="text"
                                           value="{{ old('supply_address') ? old('supply_address') : $nhacungcap->supply_address}}">
                                    @if($errors->has('supply_address'))
                                        <span class="required">{{ $errors->first('supply_address') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supply_mail">Email
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="supply_mail" class="form-control col-md-7 col-xs-12" name="supply_mail"
                                           required="required" type="email" value="{{ old('supply_mail') ? old('supply_mail') : $nhacungcap->supply_mail }}">
                                    @if($errors->has('supply_mail'))
                                        <span class="required">{{ $errors->first('supply_mail') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supply_phone">Điện thoại
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="supply_phone" class="form-control col-md-7 col-xs-12" name="supply_phone"
                                           required="required" type="text" value="{{ old('supply_phone') ? old('supply_phone') : $nhacungcap->supply_phone }}">
                                    @if($errors->has('supply_phone'))
                                        <span class="required">{{ $errors->first('supply_phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Ghi chú</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="note" class="form-control col-md-7 col-xs-12"
                                              name="note">{{ old('note') ? old('note') : $nhacungcap->note }}</textarea>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Lưu</button>
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