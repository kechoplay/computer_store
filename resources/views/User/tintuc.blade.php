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
            <div class="col-md-9">
                @foreach($tintucs as $tt)
                    <a href="{{route('chitiettintuc', ['id' => $tt->id])}}">
                        <div class="row laytintuc">
                            <img src="{{ $tt->image }}" alt="" class="col-md-3">
                            <div class="text-tintuc col-md-9">
                                <h3>{{$tt->title}}</h3>
                                <p>{{$tt->sort_description}}</p>
                                <span>Ngày đăng: {{$tt->date}}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@endsection()