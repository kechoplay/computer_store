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
                        <div class="col-xs-3">
                            <div class='input-group date' id='TuNgay'>
                                <input type='text' name="TuNgay" class="form-control" placeholder="Từ Ngày"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class='input-group date' id='DenNgay'>
                                <input type='text' name="DenNgay" class="form-control" placeholder="Đến Ngày"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                </form>
                <canvas id="chartDoanhThu" width="400" height="100"></canvas>
                {{--                <a href="{{route('baocao.xuatExcelDoanhThu', ['TuNgay' => $TuNgay, 'DenNgay' => $DenNgay])}}" class="btn btn-primary">Xuất excel</a>--}}
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Thời gian</th>
                        <th>Tổng tiền</th>
                        <th> Xem chi tiết
                        <th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachhoadon as $hoadon)
                        <tr>
                            <td>{{$hoadon->id}}</td>
                            <td>{{$hoadon->customer_name}}</td>
                            <td>{{$hoadon->phone}}</td>
                            <td>{{$hoadon->time_buy}}</td>
                            <td>{{number_format($hoadon->tongtien())}}</td>
                            <td>
                                <a href="{{route('orderDetailView',['id' => $hoadon->id])}}">
                                    <button type="button" class="btn btn-info">Xem chi tiết</button>
                                </a>
                            </td>
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

        var ctx = document.getElementById("chartDoanhThu").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($danhsachngay as $ngay)
                        "{{$ngay}}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Doanh thu',
                    data: [
                        @foreach($danhsachdoanhthu as $doanhthu)
                        {{$doanhthu}},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return value.toLocaleString();
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                            if (label) {
                                label += ': ';
                            }
                            label += tooltipItem.yLabel.toLocaleString();
                            return label;
                        }
                    }
                }
            }
        });
    </script>
@endpush()