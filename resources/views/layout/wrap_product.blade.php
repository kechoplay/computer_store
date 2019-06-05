<div class="col-md-4 top_grid1-box1">
    <div class="grid_1">
        <a href="{{ route('chitietsanpham', ['id' => $id]) }}">
            <div class="b-link-stroke b-animate-go  thickbox">
                <img src="{{ $image }}" class="img-responsive" alt=""
                     style="width: 100%; height: 300px">
            </div>
        </a>
        <div class="grid_2" style="height: 100px;">
            <a href="{{ route('chitietsanpham', ['id' => $id]) }}"><p>{{ $product_name }}</p></a>
            <ul class="grid_2-bottom">
                <li class="grid_2-left">
                    @if($is_sale == 1)
                        <p class="reducedfrom2">{{ number_format($price) }}</p>
                    @else
                        <p class="reducedfrom">{{ number_format($price) }}</p>
                    @endif
                </li>
                <li class="grid_2-right">
                    <div class="btn btn-primary btn-normal btn-inline " >
                        <a href="{{ route('addCart', ['id' => $id]) }}"
                           style="color:#ffffff;">Mua</a>
                    </div>
                </li>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
</div>