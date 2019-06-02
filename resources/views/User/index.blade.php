@extends('layout.user.main')

@section('content')

    <div class="col-md-9 content_right">
        <h4 class="head"><span class="m_2">Sản phẩm mới nhất</span></h4>
        <div class="top_grid2">
            @foreach($sanphamnew as $new)
                <div class="col-md-4 top_grid1-box1">
                    <div class="grid_1">
                        <a href="{{ route('chitietsanpham', ['id' => $new->id]) }}">
                            <div class="b-link-stroke b-animate-go  thickbox">
                                <img src="{{ $new->image }}" class="img-responsive" alt=""
                                     style="width: 100%; height: 300px">
                            </div>
                        </a>
                        <div class="grid_2" style="height: 100px;">
                            <a href="{{ route('chitietsanpham', ['id' => $new->id]) }}"><p>{{ $new->product_name }}</p></a>
                            <ul class="grid_2-bottom">
                                <li class="grid_2-left">
                                    <p>{{ number_format($new->price) }}</p>
                                </li>
                                <li class="grid_2-right">
                                    <div class="btn btn-primary btn-normal btn-inline " target="_self"
                                         title="Get It">
                                        Mua
                                    </div>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>

        <h4 class="head"><span class="m_2">Sản phẩm khuyễn mãi</span></h4>
        <div class="top_grid2">
            @foreach($danhsachkhuyenmai as $new)
                <div class="col-md-4 top_grid1-box1">
                    <div class="grid_1">
                        <a href="{{ route('chitietsanpham', ['id' => $new->sanpham->id]) }}">
                            <div class="b-link-stroke b-animate-go  thickbox">
                                <img src="{{ $new->sanpham->image }}" class="img-responsive" alt=""
                                     style="width: 100%; height: 300px">
                            </div>
                        </a>
                        <div class="grid_2" style="height: 100px;">
                            <a href="{{ route('chitietsanpham', ['id' => $new->id]) }}"><p>{{ $new->sanpham->product_name }}</p></a>
                            <ul class="grid_2-bottom">
                                <li class="grid_2-left">
                                    <p>{{ number_format($new->sanpham->price - ($new->sanpham->price * $new->sale / 100)) }}</p>
                                </li>
                                <li class="grid_2-right">
                                    <div class="btn btn-primary btn-normal btn-inline " target="_self"
                                         title="Get It">
                                        Mua
                                    </div>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>

@endsection()