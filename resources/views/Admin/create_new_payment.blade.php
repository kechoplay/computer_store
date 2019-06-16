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
                <h3>Thêm hình thức thanh toán</h3>
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
                        <h2>Thông tin hình thức thanh toán</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate method="post"
                              action="{{ route('storeNewPayment') }}">
                            {{ csrf_field() }}

                            <div style="text-align: center; margin-bottom: 10px;color: red; font-size: 15px;">
                                <span>{{ $errors->first('error') ? $errors->first('error') : '' }}</span>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_name">Tên hình
                                    thức
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="payment_name" class="form-control col-md-7 col-xs-12" name="payment_name"
                                           required="required" type="text" value="{{ old('payment_name') }}">
                                    @if($errors->has('payment_name'))
                                        <span class="required">{{ $errors->first('payment_name') }}</span>
                                    @endif
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