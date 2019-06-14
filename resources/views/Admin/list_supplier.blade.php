@extends('layout.admin.main')

@push('css')
    <!-- Datatables -->
    <link href="/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush()

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý nhà cung cấp</h3>
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
                        <h2>Danh sách nhà cung cấp</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div style="text-align: center; margin-bottom: 10px;color: red; font-size: 15px;">
                            <span>{{ $errors->first('error') ? $errors->first('error') : '' }}</span>
                        </div>
                        <a href="{{ route('addNewSupplierView') }}"><button type="button" class="btn btn-primary">Thêm nhà cung cấp</button></a>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Tên nhà cung cấp</th>
                                <th>Địa chỉ</th>
                                <th>Mail</th>
                                <th>Số điện thoại</th>
                                <th>Ghi chú</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($nhacungcap as $cc)
                                <tr>
                                    <td>{{ $cc->supply_name }}</td>
                                    <td>{{ $cc->supply_address }}</td>
                                    <td>{{ $cc->supply_mail }}</td>
                                    <td>{{ $cc->supply_phone }}</td>
                                    <td>{{ $cc->note }}</td>
                                    <td>
                                        <a href="{{ route('deleteSupplier', ['id' => $cc->id]) }}" onclick="return confirm('Bạn có chắc muốn xóa không?')"><button type="button" class="btn btn-danger">Xóa</button></a>
                                        <br>
                                        <a href="{{ route('updateSupplierView', ['id' => $cc->id]) }}" ><button type="button" class="btn btn-primary">Cập nhật</button></a>
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

@push('js')
    <script src="/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="/vendors/jszip/dist/jszip.min.js"></script>
@endpush()