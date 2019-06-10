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
        .required {
            color: red;
        }
    </style>
@endpush
@section('content')

    <form style="width:40%; margin:auto; background-color:#fff;padding:20px 20px;" method="POST">
        {{csrf_field()}}
        <h3 class="text-center">Thành viên đăng nhập</h3>
        <p class="text-center">Hãy đăng nhập thành viên để trải nghiệm đầy đủ các tiện ích trên site</p>
        @if(old('message'))
            <span class="required">
                    {{ old('message') }}
                </span>
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">Tài khoản</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Nhập mail hoặc SDT">
            @if($errors->has('name'))
                <span class="required">
                    {{$errors->first('name')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                   placeholder="Mật khẩu">
            @if($errors->has('password'))
                <span class="required">
                    {{$errors->first('password')}}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary" style=" margin-bottom:10px;">Đăng nhập</button>
        <div>
            <a href="{{ route('registerView') }}">Đăng ký thành viên</a>
        </div>
    </form>

@endsection()