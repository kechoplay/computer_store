@extends('layout.admin.main')

@push('css')
    <!-- Datatables -->
    <link href="/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush()

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thống kê doanh thu</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form action="">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class='input-group date' id='TuNgay'>
                                <input type='text' name="TuNgay" class="form-control" placeholder="Từ Ngày"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class='input-group date' id='DenNgay'>
                                <input type='text' name="DenNgay" class="form-control" placeholder="Đến Ngày"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                </form>

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Số lượt mua</th>
                        <th>Tổng doanh thu</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachsanpham as $sanpham)
                        <tr>
                            <td>{{$sanpham->id}}</td>
                            <td>{{$sanpham->product_name}}</td>
                            <td>{{$sanpham->danhmuc->cat_name}}</td>
                            <td>{{$luotmua[$sanpham->id]}}</td>
                            <td>{{number_format($tongtien[$sanpham->id])}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection()

@push('js')
    <script src="/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/vendors/Chart.js/dist/Chart.min.js"></script>
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
    <script>
        $('#TuNgay').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: "{{$TuNgay}}"
        });
        $('#DenNgay').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: "{{$DenNgay}}"
        });
    </script>
@endpush()