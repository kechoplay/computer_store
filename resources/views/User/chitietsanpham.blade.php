@extends('layout.user.main')

@section('content')

    <div class="col-md-9 single_right">
        <div class="single_top">
            <div class="single_grid">
                <div class="grid images_3_of_2">
                    <ul id="etalage" class="etalage" style="display: block; width: 300px; height: 533px;">
                        <li class="etalage_thumb thumb_3 etalage_thumb_active"
                            style="background-image: none; display: list-item; opacity: 1;">
                            <img class="etalage_thumb_image" src="{{ $sanpham->image }}"
                                 style="display: inline; width: 300px; height: 400px; opacity: 1;">
                            <img class="etalage_source_image" src="{{ $sanpham->image }}">
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="desc1 span_3_of_2">
                    <h1> {{ $sanpham->product_name }}</h1>
                    <p class="availability">Availability: <span class="color">In stock</span></p>
                    <div class="price_single">
                        <span class="reducedfrom">{{ number_format($sanpham->price) }}</span>
                        <span class="actual">$120.00</span>
                    </div>
                    <h2 class="quick">Quick Overview:</h2>
                    <p class="quick_desc">Nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non
                        habent claritatem insitam; es</p>
                    <div class="wish-list">
                        <ul>
                            <li class="wish"><a href="#">Add to Wishlist</a></li>
                            <li class="compare"><a href="#">Add to Compare</a></li>
                        </ul>
                    </div>
                    <ul class="size">
                        <h3>Length</h3>
                        <li><a href="#">32</a></li>
                        <li><a href="#">34</a></li>
                    </ul>
                    <div class="quantity_box">
                        <ul class="product-qty">
                            <span>Quantity:</span>
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                            </select>
                        </ul>
                        <ul class="single_social">
                            <li><a href="#"><i class="fb1"> </i> </a></li>
                            <li><a href="#"><i class="tw1"> </i> </a></li>
                            <li><a href="#"><i class="g1"> </i> </a></li>
                            <li><a href="#"><i class="linked"> </i> </a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <a href="reservation.html" title="Online Reservation"
                       class="btn bt1 btn-primary btn-normal btn-inline " target="_self">Buy</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="sap_tabs">
            <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                <ul class="resp-tabs-list">
                    <li class="resp-tab-item resp-tab-active" aria-controls="tab_item-0" role="tab"><span>Product Description</span>
                    </li>
                    <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Additional Information</span>
                    </li>
                    <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Reviews</span></li>
                    <div class="clear"></div>
                </ul>
                <div class="resp-tabs-container">
                    <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0"><span
                                class="resp-arrow"></span>Product Description</h2>
                    <div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0"
                         style="display:block">
                        <div class="facts">
                            <ul class="tab_list">
                                <li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                                        nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut
                                        wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                                        lobortis nisl ut aliquip ex ea commodo consequat</a></li>
                                <li><a href="#">augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta
                                        nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer
                                        possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui
                                        facit eorum claritatem. Investigatione</a></li>
                                <li><a href="#">claritatem insitam; est usus legentis in iis qui facit eorum claritatem.
                                        Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.
                                        Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium
                                        lectorum. Mirum est notare quam littera gothica</a></li>
                                <li><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram,
                                        anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta
                                        decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in
                                        futurum.</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="resp-accordion" role="tab" aria-controls="tab_item-1"><span class="resp-arrow"></span>Additional
                        Information</h2>
                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
                        <div class="facts">
                            <ul class="tab_list">
                                <li><a href="#">augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta
                                        nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer
                                        possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui
                                        facit eorum claritatem. Investigatione</a></li>
                                <li><a href="#">claritatem insitam; est usus legentis in iis qui facit eorum claritatem.
                                        Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.
                                        Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium
                                        lectorum. Mirum est notare quam littera gothica</a></li>
                                <li><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram,
                                        anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta
                                        decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in
                                        futurum.</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="resp-accordion" role="tab" aria-controls="tab_item-2"><span class="resp-arrow"></span>Reviews
                    </h2>
                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                        <ul class="tab_list">
                            <li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                    nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                                    ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo consequat</a></li>
                            <li><a href="#">augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta
                                    nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer
                                    possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit
                                    eorum claritatem. Investigatione</a></li>
                            <li><a href="#">claritatem insitam; est usus legentis in iis qui facit eorum claritatem.
                                    Investigationes demonstraverunt lectores leg</a></li>
                            <li><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram,
                                    anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta
                                    decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in
                                    futurum.</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="single_head">Related Products</h3>
        <div class="related_products">
            <div class="col-md-4 top_grid1-box1 top_grid2-box2"><a href="single.html">
                </a>
                <div class="grid_1"><a href="single.html">
                        <div class="b-link-stroke b-animate-go  thickbox">
                            <div class="b-bottom-line"></div>
                            <div class="b-top-line"></div>
                            <img src="/images/p12.jpg" class="img-responsive" alt=""></div>
                    </a>
                    <div class="grid_2"><a href="single.html">
                            <p>There are many variations of passages</p>
                        </a>
                        <ul class="grid_2-bottom"><a href="single.html">
                                <li class="grid_2-left">
                                    <p>$99
                                        <small>.33</small>
                                    </p>
                                </li>
                            </a>
                            <li class="grid_2-right"><a href="single.html"></a><a href="single.html" title="Get It"
                                                                                  class="btn btn-primary btn-normal btn-inline "
                                                                                  target="_self">Get It</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 top_grid1-box1"><a href="single.html">
                </a>
                <div class="grid_1"><a href="single.html">
                        <div class="b-link-stroke b-animate-go  thickbox">
                            <div class="b-bottom-line"></div>
                            <div class="b-top-line"></div>
                            <img src="/images/p13.jpg" class="img-responsive" alt=""></div>
                    </a>
                    <div class="grid_2"><a href="single.html">
                            <p>There are many variations of passages</p>
                        </a>
                        <ul class="grid_2-bottom"><a href="single.html">
                                <li class="grid_2-left">
                                    <p>$99
                                        <small>.33</small>
                                    </p>
                                </li>
                            </a>
                            <li class="grid_2-right"><a href="single.html"></a><a href="single.html" title="Get It"
                                                                                  class="btn btn-primary btn-normal btn-inline "
                                                                                  target="_self">Get It</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 top_grid1-box1"><a href="single.html">
                </a>
                <div class="grid_1"><a href="single.html">
                        <div class="b-link-stroke b-animate-go  thickbox">
                            <div class="b-bottom-line"></div>
                            <div class="b-top-line"></div>
                            <img src="/images/p14.jpg" class="img-responsive" alt=""></div>
                    </a>
                    <div class="grid_2"><a href="single.html">
                            <p>There are many variations of passages</p>
                        </a>
                        <ul class="grid_2-bottom"><a href="single.html">
                                <li class="grid_2-left">
                                    <p>$99
                                        <small>.33</small>
                                    </p>
                                </li>
                            </a>
                            <li class="grid_2-right"><a href="single.html"></a><a href="single.html" title="Get It"
                                                                                  class="btn btn-primary btn-normal btn-inline "
                                                                                  target="_self">Get It</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="top_grid2">
            <div class="col-md-4 top_grid1-box1 top_grid2-box2"><a href="single.html">
                </a>
                <div class="grid_1"><a href="single.html">
                        <div class="b-link-stroke b-animate-go  thickbox">
                            <div class="b-bottom-line"></div>
                            <div class="b-top-line"></div>
                            <img src="/images/p9.jpg" class="img-responsive" alt=""></div>
                    </a>
                    <div class="grid_2"><a href="single.html">
                            <p>There are many variations of passages</p>
                        </a>
                        <ul class="grid_2-bottom"><a href="single.html">
                                <li class="grid_2-left">
                                    <p>$99
                                        <small>.33</small>
                                    </p>
                                </li>
                            </a>
                            <li class="grid_2-right"><a href="single.html"></a><a href="single.html" title="Get It"
                                                                                  class="btn btn-primary btn-normal btn-inline "
                                                                                  target="_self">Get It</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 top_grid1-box1"><a href="single.html">
                </a>
                <div class="grid_1"><a href="single.html">
                        <div class="b-link-stroke b-animate-go  thickbox">
                            <div class="b-bottom-line"></div>
                            <div class="b-top-line"></div>
                            <img src="/images/p10.jpg" class="img-responsive" alt=""></div>
                    </a>
                    <div class="grid_2"><a href="single.html">
                            <p>There are many variations of passages</p>
                        </a>
                        <ul class="grid_2-bottom"><a href="single.html">
                                <li class="grid_2-left">
                                    <p>$99
                                        <small>.33</small>
                                    </p>
                                </li>
                            </a>
                            <li class="grid_2-right"><a href="single.html"></a><a href="single.html" title="Get It"
                                                                                  class="btn btn-primary btn-normal btn-inline "
                                                                                  target="_self">Get It</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 top_grid1-box1"><a href="single.html">
                </a>
                <div class="grid_1"><a href="single.html">
                        <div class="b-link-stroke b-animate-go  thickbox">
                            <div class="b-bottom-line"></div>
                            <div class="b-top-line"></div>
                            <img src="/images/p11.jpg" class="img-responsive" alt=""></div>
                    </a>
                    <div class="grid_2"><a href="single.html">
                            <p>There are many variations of passages</p>
                        </a>
                        <ul class="grid_2-bottom"><a href="single.html">
                                <li class="grid_2-left">
                                    <p>$99
                                        <small>.33</small>
                                    </p>
                                </li>
                            </a>
                            <li class="grid_2-right"><a href="single.html"></a><a href="single.html" title="Get It"
                                                                                  class="btn btn-primary btn-normal btn-inline "
                                                                                  target="_self">Get It</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

@endsection()