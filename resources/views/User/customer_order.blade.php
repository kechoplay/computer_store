@extends('layout.user.main')

@push('css')
    <style>
        .order {
            margin-top: 12px;
            padding-bottom: 24px;
            background-color: #fff;
        }

        .order-info {
            padding: 8px 12px;
            background-color: #fff;
            border-bottom: 1px solid #dadada;
            display: flex;
        }

        .order-info .info-order-left-text {
            margin-bottom: 4px;
        }

        .order-info .link {
            color: #1a9cb7;
            font-weight: 500;
        }

        .link, a {
            cursor: pointer;
        }

        .text.desc {
            font-size: 12px;
        }

        .text.info {
            color: #757575;
        }

        .text {
            color: #212121;
            word-break: break-word;
        }

        .order-info .info-order-left {
            display: flex;
            flex: 1;
            flex-direction: row;
            align-items: center;
        }

        .order-info .manage {
            line-height: 32px;
        }

        .order-item {
            min-height: 80px;
            margin: 24px 12px 24px 36px;
            padding-right: 12px;
        }

        .order-item .item-pic {
            float: left;
        }

        .order-item .item-main-mini {
            width: 280px;
        }

        .order-item .item-main {
            float: left;
            width: 360px;
            margin-left: 12px;
            margin-right: 24px;
        }

        .order-item .item-title {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
        }

        .text.title {
            font-size: 14px;
            margin-bottom: 3px;
        }

        .order-item .iconTag {
            height: 14px;
            margin-right: 4px;
        }

        .order-item .item-quantity {
            font-size: 14px;
            float: left;
            width: 64px;
            min-height: 80px;
            text-align: left;
        }

        .order-item .item-quantity .multiply {
            font-size: 14px;
        }

        .text.multiply {
            color: #c9c9c9;
        }

        .order-item .item-status {
            float: left;
            min-height: 80px;
            text-align: left;
        }

        .order-item .item-capsule {
            width: 204px;
            text-align: center;
        }

        .order-item .item-capsule .capsule {
            margin-top: -4px;
        }

        .capsule {
            font-size: 12px;
            padding: 4px 12px;
            display: inline-block;
            border-radius: 24px;
            background-color: #eff0f5;
            max-width: 150px;
        }

        .order-item .item-pic img {
            width: 80px;
            height: 80px;
        }

        .clear {
            clear: both;
        }

        .order-item .item-info {
            float: right;
            min-height: 80px;
            text-align: right;
            max-width: 204px;
        }
    </style>
@endpush

@section('content')

    @foreach($listOrder as $order)
        <div class="order">
            <div class="order-info">
                <div>
                    <div class="info-order-left-text">
                        Đơn hàng <a class="link"> #{{ $order->id }}</a>
                    </div>
                    <p class="text info desc">Đặt ngày {{ $order->time_buy }}</p>
                </div>
                <a class="pull-left info-order-left"></a>
                <a class="pull-right link manage" style="color: rgb(26, 156, 183);"></a>
                <div class="clear"></div>
            </div>
            @foreach($order->chitiethoadon as $chitiet)
                <div class="order-item">
                    <div class="item-pic" data-spm="detail_image">
                        <a href="#">
                            <img src="{{ $chitiet->sanpham->image }}">
                        </a>
                    </div>
                    <div class="item-main item-main-mini">
                        <div>
                            <div class="text title item-title" data-spm="details_title">
                                {{ $chitiet->sanpham->product_name }}
                            </div>
                            <p class="text desc"></p>
                            <p class="text desc bold"></p>
                        </div>
                    </div>
                    <div class="item-quantity">
                        <span>
                            <span class="text desc info multiply">Số lượng:</span>
                            <span class="text">&nbsp;{{ $chitiet->quantity }}</span>
                        </span>
                    </div>
                    <div class="item-status item-capsule">
                        <p class="capsule">
                            @if($order->status == '1')
                                Chưa xử lí
                            @elseif($order->status == '2')
                                Đã xử lý
                            @elseif($order->status == '3')
                                Đã giao
                            @elseif($order->status == '4')
                                Đã hủy
                            @endif
                        </p>
                    </div>
                    <div class="item-info">
                        <p class="text delivery-success" style="font-size: 14px;">
                            @if($order->status == '3')
                                Đã giao {{ $order->updated_at }}
                            @endif
                        </p>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
    @endforeach

@endsection