<?php
$danhmuc = getDanhMuc();
$tintuc = getTinTuc();
$shoppingCart = getShoppingCart();
$totalCart = count($shoppingCart);
$currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
?>
        <!DOCTYPE HTML>
<html>
<head>
    <title>Computer Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Fashionpress Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <link href="/css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Custom Theme files -->
    <link href="/css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Custom Theme files -->
    <!--webfont-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet'
          type='text/css'>
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/etalage.css">
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/responsiveslides.min.js"></script>
    <script src="/js/jquery.etalage.min.js"></script>
    <script src="/js/easyResponsiveTabs.js" type="text/javascript"></script>
    <script>
        $(function () {
            $("#slider").responsiveSlides({
                auto: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                pager: true,
            });
        });
    </script>
    <script>
        jQuery(document).ready(function ($) {

            $('#etalage').etalage({
                thumb_image_width: 300,
                thumb_image_height: 400,
                source_image_width: 900,
                source_image_height: 1200,
                show_hint: true,
                click_callback: function (image_anchor, instance_id) {
                    alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
                }
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true   // 100% fit in a container
            });
        });
    </script>
    <script type="text/javascript" src="/js/hover_pack.js"></script>
    @stack('css')
</head>
<body>
<div class="header">
    <div class="header_top">
        <div class="container">
            <div class="logo">
                <a href="{{ route('index') }}"><img src="/images/logo.png" alt=""/></a>
                <a href="{{ route('index') }}"><img src="/images/banner.png" alt="" style="height: 70px; margin-left: 100px"/></a>
            </div>
            <ul class="shopping_grid">
                @if(!\Illuminate\Support\Facades\Auth::guard('users')->check())
                    <a href="{{ route('loginUserView') }}">
                        <li>Đăng nhập</li>
                    </a>
                @else
                    <a href="{{ route('logoutUser') }}">
                        <li>Thoát</li>
                    </a>
                @endif
                <a href="{{ route('cart') }}">
                    <li><span class="m_1">Giỏ hàng</span>&nbsp;&nbsp;({{ $totalCart }}) &nbsp;
                        <img src="/images/bag.png" alt=""/>
                    </li>
                </a>
                <div class="clearfix"></div>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="h_menu4"><!-- start h_menu4 -->
        <div class="container">
            <a class="toggleMenu" href="#">Menu</a>
            <ul class="nav">
                <li class="active"><a href="{{ route('index') }}" data-hover="Home">Trang chủ</a></li>
                <li><a href="{{ route('danhsachsanpham') }}" data-hover="About Us">Danh sách sản phẩm</a></li>
                <li><a href="{{ route('danhsachkhuyenmai') }}" data-hover="Careers">Danh sách khuyến mãi</a></li>
                <li><a href="{{ route('danhsachtintuc') }}" data-hover="Contact Us">Tin tức</a></li>
                @if(\Illuminate\Support\Facades\Auth::guard('users')->check())
                    <li><a href="{{ route('customerOrder') }}" data-hover="My Order">Đơn hàng của tôi</a></li>
                @endif
                {{--<li><a href="register.html" data-hover="Company Registration">Company Registration</a></li>--}}
                {{--<li><a href="wishlist.html" data-hover="Wish List">Wish List</a></li>--}}
            </ul>
            <script type="text/javascript" src="/js/nav.js"></script>
        </div><!-- end h_menu4 -->
    </div>
</div>
@if($currentRoute == 'index')
    <div class="slider">
        <div class="callbacks_container">
            <ul class="rslides" id="slider">
                <li><img src="/images/b1.jpg" class="img-responsive" alt="" style="height: 400px"/>
                    <div class="banner_desc">
                    </div>
                </li>
                <li><img src="/images/b2.jpg" class="img-responsive" alt="" style="height: 400px"/>
                    <div class="banner_desc">
                    </div>
                </li>
                <li><img src="/images/bn1.png" class="img-responsive" alt="" style="height: 400px"/>
                    <div class="banner_desc">
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endif
<div class="column_center">
    <div class="container">
        <div class="search">
            <div class="stay">Tìm kiếm sản phẩm</div>
            <div class="stay_right">
                <form method="get" action="{{ route('searchProduct') }}">
                    <input type="text" value="" name="str" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = '';}">
                    <input type="submit" value="">
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="main">
    <div class="content_top">
        <div class="container">
            @if($currentRoute != 'cart' && $currentRoute != 'checkout' && $currentRoute != 'loginUserView'
            && $currentRoute != 'registerView' && $currentRoute != 'danhsachtintuc' && $currentRoute != 'chitiettintuc'
            && $currentRoute != 'customerOrder'
            )
                <div class="col-md-2 sidebar_box">
                    <div class="sidebar">
                        <div class="menu_box">
                            <h3 class="menu_head">Products Menu</h3>
                            <ul class="menu">
                                @foreach($danhmuc as $key => $dm)
                                    <li class="item{{ $key + 1 }}">
                                        <a href="#">
                                            <img class="arrow-img" src="/images/f_menu.png" alt=""/>{{ $dm->cat_name }}
                                        </a>
                                        @if(count($dm->children) > 0)
                                            <ul class="cute">
                                                @foreach($dm->children as $childKey => $child)
                                                    <li class="subitem{{ $childKey +1 }}">
                                                        <a href="{{ route('productCategory', ['id' => $child->id]) }}">{{ $child->cat_name }} </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--initiate accordion-->
                        <script type="text/javascript">
                            $(function () {
                                var menu_ul = $('.menu > li > ul'),
                                    menu_a = $('.menu > li > a');
                                menu_ul.hide();
                                menu_a.click(function (e) {
                                    e.preventDefault();
                                    if (!$(this).hasClass('active')) {
                                        menu_a.removeClass('active');
                                        menu_ul.filter(':visible').slideUp('normal');
                                        $(this).addClass('active').next().stop(true, true).slideDown('normal');
                                    } else {
                                        $(this).removeClass('active');
                                        $(this).next().stop(true, true).slideUp('normal');
                                    }
                                });

                            });
                        </script>
                    </div>
                    {{--<div class="delivery">--}}
                    {{--<img src="/images/delivery.jpg" class="img-responsive" alt=""/>--}}
                    {{--<h3>Delivering</h3>--}}
                    {{--<h4>World Wide</h4>--}}
                    {{--</div>--}}
                    {{--<div class="twitter">--}}
                    {{--<h3>Latest From Twitter</h3>--}}
                    {{--<ul class="twt1">--}}
                    {{--<i class="twt"> </i>--}}
                    {{--<li class="twt1_desc"><span class="m_1">@Contrary</span> to popular belief, Lorem Ipsum is<span--}}
                    {{--class="m_1"> not simply</span></li>--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--</ul>--}}
                    {{--<ul class="twt1">--}}
                    {{--<i class="twt"> </i>--}}
                    {{--<li class="twt1_desc"><span class="m_1">There are many</span> variations of passages of Lorem--}}
                    {{--Ipsum available, but the majority <span class="m_1">have suffered</span></li>--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--</ul>--}}
                    {{--<ul class="twt1">--}}
                    {{--<i class="twt"> </i>--}}
                    {{--<li class="twt1_desc"><span class="m_1">Lorem Ipsum</span> is simply dummy text of the printing--}}
                    {{--and typesetting industry. Lorem Ipsum has <span class="m_1">been the industry's standard dummy text ever</span>--}}
                    {{--</li>--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="clients">--}}
                    {{--<h3>Our Happy Clients</h3>--}}
                    {{--<h4>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque--}}
                    {{--laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto--}}
                    {{--beatae.</h4>--}}
                    {{--<ul class="user">--}}
                    {{--<i class="user_icon"></i>--}}
                    {{--<li class="user_desc"><a href="#"><p>John Doe, Company Info</p></a></li>--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                </div>
@endif