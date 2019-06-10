<?php
$now = time();
$totalPrice = 0;
?>
@extends('layout.user.main')

@push('css')
    {{--    <link rel="stylesheet" href="/css/giohang.css?time={{ $now }}">--}}
    <style>
        p {
            text-align: center;
        }

        .row {
            margin: 0;
        }

        .required {
            color: red;
        }
    </style>
@endpush
@section('content')

    <div style="width:50%; margin:auto; background-color:#fff; padding-top:25px;">
        {{csrf_field()}}
        <div class="">
            <div class="page-title">
                <div class="title_left text-center">
                    <h3>Đăng ký thành viên </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <small>Khách hàng hãy điền đầy đủ thông tin của mình</small>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <form method="post" data-parsley-validate class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <label style="padding-left:0; padding-right:0;"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên đăng nhập
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="name" name="name" required="required" value="{{ old('name') }}"
                                               class="form-control">
                                        @if($errors->has('name'))
                                            <span class="required">
                                                {{$errors->first('name')}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <label style="padding-left:0; padding-right:0;"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Mật khẩu
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="password" id="password" name="password" required="required" value="{{ old('password') }}"
                                               class="form-control ">
                                        @if($errors->has('password'))
                                            <span class="required">
                                                {{$errors->first('password')}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <label style="padding-left:0; padding-right:0;"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Tên khách
                                        hàng
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="fullname" name="fullname" required="required" value="{{ old('fullname') }}"
                                               class="form-control ">
                                        @if($errors->has('fullname'))
                                            <span class="required">
                                                {{$errors->first('fullname')}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <label style="padding-left:0; padding-right:0;"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Địa chỉ
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="address" name="address" required="required" value="{{ old('address') }}"
                                               class="form-control ">
                                        @if($errors->has('address'))
                                            <span class="required">
                                                {{$errors->first('address')}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <label style="padding-left:0; padding-right:0;"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Số điện thoại
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="phone" name="phone" required="required" value="{{ old('phone') }}"
                                               class="form-control ">
                                        @if($errors->has('phone'))
                                            <span class="required">
                                                {{$errors->first('phone')}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <label style="padding-left:0; padding-right:0;"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="email" id="email" name="email" required="required" value="{{ old('email') }}"
                                               class="form-control ">
                                        @if($errors->has('email'))
                                            <span class="required">
                                                {{$errors->first('email')}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <label style="padding-left:0; padding-right:0;"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Giới tính
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="1" checked>Nam </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="0">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="row form-group" style="margin-bottom:13px !important;">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Đăng ký</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()