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
                        <h2>Thành viên</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <a href="{{ route('addNewUserView') }}"><button type="button" class="btn btn-primary">Thêm thành viên</button></a>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Ảnh đại diện</th>
                                <th>Tên đăng nhập</th>
                                <th>Tên đầy đủ</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>Lần đăng nhập cuối</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listUser as $user)
                            <tr>
                                <td><img src="{{ $user['image'] }}" style="width: 100px;"></td>
                                <td>{{ $user['username'] }}</td>
                                <td>{{ $user['fullname'] }}</td>
                                <td>{{ $user['address'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['mobile'] }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($user['birthday']))->format('Y-m-d') }}</td>
                                <td>{{ $user['gender'] == 1 ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ $user['last_login_time'] ? \Carbon\Carbon::createFromTimestamp(strtotime($user['last_login_time']))->format('Y-m-d H:i:s') : 0}}</td>
                                <th><a href="{{ route('deleteUser', ['id' => $user['id']]) }}" onclick="return confirm('Bạn có chắc muốn xóa không?')"><button type="button" class="btn btn-danger">Xóa</button></a></th>
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