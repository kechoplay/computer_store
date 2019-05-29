@extends('layout.admin.main')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thành viên</h3>
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
                        <h2>Quản lý sản phẩm </h2>
                        <div class="clearfix"></div>
                        <a href="{{route('createProductView')}}">
                            <button type="button" class="btn btn-info">Tạo mới</button>
                        </a>


                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Tên danh mục</th>
                                <th>Số lượng</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <!-- <th>Ghi chú</th>
                                <th>Thời gian bảo hành</th>
                                <th>RAM</th>
                                <th>Ổ cứng</th>
                                <th>Sản phẩm mới</th>
                                <th>Chi tiết</th> -->
                                <th>Sửa sản phẩm</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sanpham as $sp)
                                <tr>
                                    <td style="max-width:100px;">{{$sp->TenSP}}</td>
                                    <td>{{$sp->danhmuc['cat_name']}} </td>
                                    <td>{{$sp->SoLuong}}</td>
                                    <td>
                                        <img src="{{$sp->HinhAnh}}" width="100px">
                                    </td>
                                    <td>{{number_format($sp->Gia)}}</td>
                                <!-- <td style="max-width:200px;">{{$sp->GhiChu}}</td>
                        <td>{{number_format($sp->ThoiHanBH)}}</td>
                        <td>{{$sp->RAM}}</td>
                        <td>{{$sp->HDD}}</td>
                        @if(($sp->SPNew)==0)
                                    <td>{{'Sản phẩm mới'}}</td>
                        @else
                                    <td>{{'Sản phẩm cũ'}}</td>
                        @endif
                                        <td>
                                            <a href="">Xem chi tiết</a>
                                        </td> -->
                                    <td>
                                        <a href="{{route('quanlysanpham.update',['MaSP'=>$sp->MaSP])}}"
                                           class="label label-success" title="Sửa">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection