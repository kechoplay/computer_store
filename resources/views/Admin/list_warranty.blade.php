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
                <h3>Quản lý phiếu bảo hành</h3>
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
                        <h2>Danh sách phiếu bảo hành</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Khách hàng</th>
                                <th>SĐT</th>
                                <th>Sản phẩm</th>
                                <th>Ngày mua</th>
                                <th>Thời hạn bảo hành</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($phieubaohanh as $tt)
                                <tr>
                                    <td>{{ $tt->order_id }}</td>
                                    <td>{{ $tt->customer_name }}</td>
                                    <td>{{ $tt->phone }}</td>
                                    <td>{{ $tt->sanpham->product_name }}</td>
                                    <td>{{ $tt->buy_date }}</td>
                                    <td>{{ $tt->warranty }}</td>
                                    <td>
                                        <div id="print-area" class="hidden">
                                            <h3 class="text-center">Phiếu bảo hành</h3>
                                            <div class="row">
                                                <label class="col-xs-3">Mã hóa đơn</label>
                                                <div class="col-xs-9">{{ $tt->order_id }} </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-3">Tên khách hàng</label>
                                                <div class="col-xs-9">{{ $tt->customer_name }} </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-3">Số điện thoại</label>
                                                <div class="col-xs-9">{{ $tt->phone }} </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-3">Mã sản phẩm</label>
                                                <div class="col-xs-9">{{ $tt->sanpham->id}} </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-3">Tên sản phẩm</label>
                                                <div class="col-xs-9">{{ $tt->sanpham->product_name }} </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-3">Ngày mua</label>
                                                <div class="col-xs-9">{{ $tt['buy_date'] }} </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xs-3">Thời hạn bảo hành</label>
                                                <div class="col-xs-9">{{ $tt['warranty'] }} tháng</div>
                                            </div>
                                            <div class="row text-center">
                                                <label class="col-xs-6">Khách hàng</label>
                                                <label class="col-xs-6">Nhân viên</label>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-info" onclick="printDiv('print-area')">In phiếu bảo hành</button>
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