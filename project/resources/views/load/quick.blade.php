<div class="row product-details-page py-0">
            <div class="col-lg-5">

          <div class="xzoom-container">
              <img class="quick-zoom" id="xzoom-magnific1" src="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}" xoriginal="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}" />
              <div class="xzoom-thumbs">

                <div class="quick-all-slider">

                    <a href="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}">
                  <img class="quick-zoom-gallery" width="80" src="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}" title="The description goes here">
                    </a>

                @foreach($product->galleries as $gal)


                    <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                  <img class="quick-zoom-gallery" width="80" src="{{asset('assets/images/galleries/'.$gal->photo)}}" title="The description goes here">
                    </a>

                @endforeach

                </div>
                  
              </div>
          </div>

            </div>
    <div class="col-lg-7">
        <div class="right-area">
            <div class="product-info">
                <h4 class="product-name"><a target="_blank" href="{{ route('front.product',$product->slug) }}">{{ $product->name }}</a></h4>
                <div class="info-meta-1">
                    <ul>
                        <li class="product-id">
                            <p>
                                {{ $langg->lang77 }}: <span class="idno">{{ sprintf("%'.08d",$product->id) }}</span>
                            </p>
                        </li>
                        @if($product->type == 'Physical')
                            @if($product->stock === 0)
                                <li class="product-outstook">
                                    <p>
                                        <i class="icofont-close-circled"></i>
                                        {{ $langg->lang78 }}
                                    </p>
                                </li>
                            @else
                                <li class="product-isstook">
                                    <p>
                                        <i class="icofont-check-circled"></i>
                                        {{ $langg->lang79 }}
                                    </p>
                                </li>
                            @endif
                        @endif
                        <li>
                            <div class="ratings">
                                <div class="empty-stars"></div>
                                <div class="full-stars" style="width:{{App\Models\Rating::ratings($product->id)}}%"></div>
                            </div>
                        </li>
                        <li class="review-count">
                            <p>{{count($product->ratings)}} {{ $langg->lang80 }}</p>
                        </li>
                    </ul>
                </div>
                <div class="info-meta-2">
                    <ul>

                        @if($product->type == 'License')

                            @if($product->platform != null)
                                <li>
                                    <p>{{ $langg->lang82 }}: <b>{{ $product->platform }}</b></p>
                                </li>
                            @endif

                            @if($product->region != null)
                                <li>
                                    <p>{{ $langg->lang83 }}: <b>{{ $product->region }}</b></p>
                                </li>
                            @endif

                            @if($product->licence_type != null)
                                <li>
                                    <p>{{ $langg->lang84 }}: <b>{{ $product->licence_type }}</b></p>
                                </li>
                            @endif

                        @endif


                        @if($product->product_condition != 0)
                            <li>
                                <p>{{ $langg->lang85 }}: <b>{{ $product->product_condition == 2 ? 'New' : 'Used' }}</b></p>
                            </li>
                        @endif

                        @if($product->ship != null)
                            <li>
                                <p>{{ $langg->lang86 }}: <b> {{ $product->ship }}</b></p>
                            </li>
                        @endif

                    </ul>
                </div>

                <div class="product-price">
                    <p class="title">{{ $langg->lang87 }} :</p>
                    <p class="price"><span id="msizeprice">{{ $product->showPrice() }}</span> <small><del>{{ $product->showPreviousPrice() }}</del></small></p>
                </div>

                @if(!empty($product->size))
                    <div class="mproduct-size">
                        <p class="title">{{ $langg->lang88 }} :</p>
                        <ul class="siz-list">
                            @php
                                $is_first = true;
                            @endphp
                            @foreach($product->size as $key => $data1)
                                <li class="{{ $is_first ? 'active' : '' }}">
                        <span class="box">{{ $data1 }}
                            <input type="hidden" class="msize" value="{{ $data1 }}">
                  <input type="hidden" class="msize_qty" value="{{ $product->size_qty[$key] }}">
                  <input type="hidden" class="msize_key" value="{{$key}}">
                  <input type="hidden" class="msize_price" value="{{ round($product->size_price[$key] * $curr->value,2) }}">
                        </span>
                                </li>
                                @php
                                    $is_first = false;
                                @endphp
                            @endforeach
                            <li>
                        </ul>
                    </div>
                @endif

                @if(!empty($product->color))
                    <div class="mproduct-color">
                        <p class="title">{{ $langg->lang89 }} :</p>
                        <ul class="color-list">
                            @php
                                $is_first = true;
                            @endphp
                            @foreach($product->color as $key => $data1)
                                <li class="{{ $is_first ? 'active' : '' }}">
                                    <span class="box" style="background-color: {{ $product->color[$key] }}"></span>
                                </li>
                                @php
                                    $is_first = false;
                                @endphp
                            @endforeach

                        </ul>
                    </div>
                @endif

                @if(!empty($product->size))

                    <input type="hidden" class="product-stock" id="stock" value="{{ $product->size_qty[0] }}">
                @else
                    @php
                        $stck = (string)$product->stock;
                    @endphp
                    @if($stck != null)
                        <input type="hidden" class="product-stock"  value="{{ $stck }}">
                    @elseif($product->type != 'Physical')
                        <input type="hidden" class="product-stock"  value="0">
                    @else
                        <input type="hidden" class="product-stock" value="">
                    @endif

                @endif
                <input type="hidden" id="mproduct_price" value="{{ round($product->vendorPrice() * $curr->value,2) }}">
                <input type="hidden" id="mproduct_id" value="{{ $product->id }}">
                <input type="hidden" id="mcurr_pos" value="{{ $gs->currency_format }}">
                <input type="hidden" id="mcurr_sign" value="{{ $curr->sign }}">
                <div class="info-meta-3">
                    <ul class="meta-list">
                        <li class="count {{ $product->type == 'Physical' ? '' : 'd-none' }}">
                            <div class="qty">
                                <ul>
                                    <li>
                            <span class="modal-minus">
                              <i class="icofont-minus"></i>
                            </span>
                                    </li>
                                    <li>
                                        <span class="modal-total">1</span>
                                    </li>
                                    <li>
                            <span class="modal-plus">
                              <i class="icofont-plus"></i>
                            </span>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        @if($product->product_type == "affiliate")

                        <li class="addtocart">
                          <a href="{{ route('affiliate.product', $product->slug) }}" target="_blank"><i
                              class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                        </li>
                        @else
                        @if($product->stock === 0)
                        <li class="addtocart">
                          <a href="javascript:;" class="cart-out-of-stock">
                            <i class="icofont-close-circled"></i> 
                            {{ $langg->lang78 }}</a>
                        </li>                    
                        @else 
                        <li class="addtocart">
                          <a href="javascript:;" id="maddcrt"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                        </li>
    
                        <li class="addtocart">
                          <a href="{{ route('product.cart.quickadd',$product->id) }}"><i
                              class="icofont-cart"></i>{{ $langg->lang251 }}</a>
                        </li>
                        @endif

                        @endif
                        @if(Auth::guard('web')->check())
                            <li class="favorite">
                                <a href="javascript:;" class="add-to-wish" data-href="{{ route('user-wishlist-add',$product->id) }}"><i class="icofont-heart-alt"></i></a>
                            </li>
                        @else
                            <li class="favorite">
                                <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i class="icofont-heart-alt"></i></a>
                            </li>
                        @endif
                        <li class="compare">
                            <a href="javascript:;" class="add-to-compare" data-href="{{ route('product.compare.add',$product->id) }}"><i class="icofont-exchange"></i></a>
                        </li>
                    </ul>
                    @if(!empty($product->whole_sell_qty))
                  <div class="table-area mt-3">
                    <table class="table">
                        <tr>
                          <th>{{ $langg->lang768 }}</th>
                          <th>{{ $langg->lang769 }}</th>
                        </tr>
                        @foreach($product->whole_sell_qty as $key => $data1)                     
                        <tr>
                          <td>{{ $langg->lang770 }}: {{ $product->whole_sell_qty[$key] }}+</td>
                          <td>{{ $product->whole_sell_discount[$key] }}% {{ $langg->lang771 }}</td>
                        </tr>
                        @endforeach
                      </table>
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    
@media (min-width: 1200px) { 

.xzoom-preview {
    width: 450px !important;
    height: 390px !important;
    background: white;
    position: inherit;
    z-index: 99999;
}

}


</style>

  <script src="{{asset('assets/front/js/quicksetup.js')}}"></script>

<script type="text/javascript">
    var sizes = "";
    var size_qty = "";
    var size_price = "";
    var size_key = "";
    var colors = "";
    var mtotal = "";
    var mstock = $('.product-stock').val();


    // Product Details Product Size Active Js Code
    $('.mproduct-size .siz-list .box').on('click', function () {
        $('.modal-total').html('1');
        var parent = $(this).parent();
        size_qty = $(this).find('.msize_qty').val();
        size_price = $(this).find('.msize_price').val();
        size_key = $(this).find('.msize_key').val();
        sizes = $(this).find('.msize').val();
        $('.mproduct-size .siz-list li').removeClass('active');
        parent.addClass('active');
        var value = $('#mproduct_price').val();
        total = parseFloat(value)+parseFloat(size_price);
        stock = size_qty;
        var pos = $('#mcurr_pos').val();
        var sign = $('#mcurr_sign').val();
        if(pos = 0)
        {
            $('#msizeprice').html(sign+total);
        }
        else {
            $('#msizeprice').html(total+sign);
        }

    });

    // Product Details Product Color Active Js Code
    $('.mproduct-color .color-list .box').on('click', function () {
        colors = $(this).css('background-color');
        var parent = $(this).parent();
        $('.mproduct-color .color-list li').removeClass('active');
        parent.addClass('active');

    });

    $('.modal-minus').on('click', function () {
        var el = $(this);
        var $tselector = el.parent().parent().find('.modal-total');
        total = $($tselector).text();
        if (total > 1) {
            total--;
        }
        $($tselector).text(total);
    });

    $('.modal-plus').on('click', function () {
        var el = $(this);
        var $tselector = el.parent().parent().find('.modal-total');
        total = $($tselector).text();
        if(mstock != "")
        {
            var stk = parseInt(mstock);
            if(total < stk)
            {
                total++;
                $($tselector).text(total);
            }
        }
        else {
            total++;
        }
        $($tselector).text(total);
    });

    $("#maddcrt").on("click", function(){
        var qty = $('.modal-total').html();
        var pid = $(this).parent().parent().parent().parent().find("#mproduct_id").val();
        $.ajax({
            type: "GET",
            url:mainurl+"/addnumcart",
            data:{id:pid,qty:qty,size:sizes,color:colors,size_qty:size_qty,size_price:size_price,size_key:size_key},
            success:function(data){
                if(data == 'digital') {
                    toastr.error(langg.already_cart);
                }
                else if(data == 0) {
                    toastr.error(langg.out_stock);
                }
                else {
                    $("#cart-count").html(data[0]);
                    $("#cart-items").load(mainurl+'/carts/view');
                    toastr.success(langg.add_cart);
                }
            }
        });
    });

</script>