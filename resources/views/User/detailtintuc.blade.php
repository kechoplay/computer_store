<?php
$now = time();
?>
@extends('layout.user.main')

@push('css')
    <link rel="stylesheet" href="/css/tintuc.css?time={{ $now }}">
    <style>

    </style>
@endpush
@section('content')

    <div class="tintuc">
        <div class="row menu-tintuc">
            <a href="#">Tin mới</a>
        </div>
        <div class="row content-tintuc">
            <h1>{{$tintuc->title}}</h1>
            <div class="list">
                <ul>
                    <li>Người đăng: {{$tintuc->admin->fullname }}</li>
                    <li>Ngày: {{$tintuc->date}}</li>
                </ul>
            </div><br>
            <p>{!!$tintuc->description!!}</p>
        </div>
    </div>

@endsection()