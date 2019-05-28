@extends('layout.admin.main')

@push('css')
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush()

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Danh muc</h3>
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
                        <h2>Danh muc</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
{{--                        <a href="{{ route('addNewCategoryView') }}"><button type="button" class="btn btn-primary">Thêm danh muc</button></a>--}}
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Ten danh muc</th>
                                <th>vi tri</th>
                                <th>danh muc cha</th>
                                <th>trang thai</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($danhmuc as $ca)
                                <tr>
                                    <td>{{ $ca['cat_name'] }}</td>
                                    <td>{{ $ca['sort_order'] }}</td>
                                    <td>{{ $ca['parent_id'] }}</td>
                                    <td>{{ $ca['cat_status'] == 1 ? "Hien thi" : "An" }}</td>
                                    <td>
                                        {{--<a href="{{ route('deleteUser', ['id' => $ca['id']]) }}" onclick="return confirm('Bạn có chắc muốn xóa không?')"><button type="button" class="btn btn-danger">Xóa</button></a>--}}
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
@endsection()