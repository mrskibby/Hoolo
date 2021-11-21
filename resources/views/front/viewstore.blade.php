@extends('front.layout.master')
@section('title',$store->name.' | ')
@section('body')

<div class="body-content outer-top-vs" id="top-banner-and-menu">
    <div class="container-fluid">

        <div class="clearfix my-wishlist-page m-t-10">

            <div id="category" class="category-carousel">
                <div class="item">
                    <div class="image"> <img
                            src="{{ $store->cover_photo !='' && file_exists(public_path().'/images/store/cover_photo/'.$store->cover_photo) ? url('images/store/cover_photo/'.$store->cover_photo) : url('images/default_cover_store.jpg') }}"
                            alt="" class="img-fluid"> </div>
                    <div class="container-fluid">
                        <div class="caption vertical-top text-left">
                            <div class="big-text"> {{ $store->name }} @if($store->verified_store == '1') <small
                                    title="Verified"><i class="d-inline-flex fa fa-check-circle text-green"></i>
                                </small> @endif </div>
                            @if($store->description !='')
                            <div class="excerpt hidden-sm hidden-md"> {!! $store->description !!} </div>
                            @endif
                            <div class="mt-2 excerpt-normal hidden-sm hidden-md">

                                <p><i class="fa fa-map-marker"></i> {{ $store['address'] }} {{ $store->city['name'] }},
                                    {{ $store->state['name'] }}, {{ $store->country['nicename'] }},
                                    {{ $store->pin_code }}</p>

                                <p><i class="fa fa-phone"></i> <a class="text-dark" href="tel:{{ $store['mobile'] }}">{{ $store['mobile'] }}</a></p>



                                <p><i class="fa fa-envelope"></i> <a class="text-dark" href="mailto:{{ $store->email }}">{{ $store->email }}</a> </p>


                                @if($google_reviews != NULL)
                                <h6 role="button" data-toggle="modal" data-target="#reviewsgoogle"><span
                                        class="badge badge-primary"> <i class="fa fa-star"></i> {{$google_reviews['rating']}}
                                        {{ __("Google Reviews") }}</span> </h6>
                                @endif

                            </div>
                        </div>
                        <!-- /.caption -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
            </div>

            <div class="filter-tabs">
                <div class="filter-tab-dropdown">
                    <div class="row no-gutters">
                        <div class="col-lg-4 col-12">
                            <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#grid-container"><i
                                            class="icon fa fa-th-large"></i> Grid</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#list-container" class="nav-link"><i
                                            class="icon fa fa-bars"></i>
                                        List</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="filter-pagination">
                                <div class="">
                                    {!! $products->appends(Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="filter-dropdown">
                                <ul>
                                    <li>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle"
                                                data-toggle="dropdown">
                                                Show items :
                                                {{ !app('request')->input('limit') ? 10 : app('request')->input('limit') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                @php
                                                $sort = !app('request')->input('sort') ? 'A-Z' :
                                                app('request')->input('sort');
                                                @endphp
                                                <a class="{{ !app('request')->input('limit') || app('request')->input('limit') == 10  ? 'active' : "" }} dropdown-item"
                                                    href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => $sort , 'limit' => 10]) }}">10</a>
                                                <a class="{{ app('request')->input('limit') == 25 ? 'active' : "" }} dropdown-item"
                                                    href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => $sort , 'limit' => 25]) }}">25</a>
                                                <a class="{{ app('request')->input('limit') == 50 ? 'active' : "" }} dropdown-item"
                                                    href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => $sort , 'limit' => 50]) }}">50</a>
                                                <a class="{{ app('request')->input('limit') == 100 ? 'active' : "" }} dropdown-item"
                                                    href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => $sort , 'limit' => 100]) }}">100</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle"
                                                data-toggle="dropdown">
                                                Sort By :
                                                {{ !app('request')->input('sort') ? "A-Z" : app('request')->input('sort') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                @php
                                                $limit = !app('request')->input('limit') ? 10 :
                                                app('request')->input('limit');
                                                @endphp
                                                <a class="{{ !app('request')->input('sort') || app('request')->input('sort') == "A-Z"  ? 'active' : "" }} dropdown-item"
                                                    href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => 'A-Z', 'limit' => $limit]) }}">A-Z</a>
                                                <a class="{{ app('request')->input('sort') == "Z-A" ? 'active' : "" }} dropdown-item"
                                                    href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => "Z-A", 'limit' => $limit ]) }}">Z-A</a>
                                                {{-- <a class="{{ app('request')->input('sort') == 50 ? 'active' : "" }}
                                                dropdown-item"
                                                href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => 50]) }}">50</a>
                                                <a class="{{ app('request')->input('sort') == 100 ? 'active' : "" }} dropdown-item"
                                                    href="{{ route('store.view',['uuid' => $store->uuid ?? 0, 'title' => $store->name, 'sort' => 100]) }}">100</a>
                                                --}}
                                            </div>
                                        </div>
                                    </li>
                                </ul>





                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <span class="text-total">
                    <b>({{__('staticwords.Showingproducts')}} {{ $products->count() }} {{__("staticwords.of")}}
                        {{ $store->products()->count() }})</b>
                </span>






            </div>

            <div id="myTabContent" class="tab-content category-list">

                <div class="tab-pane fade show active" id="grid-container">
                    <div class="row">
                        @if(count($products) > 0)
                        @foreach($products as $key => $pro)

                        @if($pro->subvariants->count() > 0)
                        @foreach($pro->subvariants as $orivar)

                        @if($orivar->def == '1')

                        @php

                        $var_name_count = count($orivar['main_attr_id']);

                        $name = array();
                        $var_name;
                        $newarr = array();

                        for($i = 0; $i<$var_name_count; $i++){ $var_id=$orivar['main_attr_id'][$i];
                            $var_name[$i]=$orivar['main_attr_value'][$var_id];
                            $name[$i]=App\ProductAttributes::where('id',$var_id)->first();

                            }


                            try{

                            $url =
                            url('details').'/'.$pro->id.'?'.$name[0]['attr_name'].'='.$var_name[0].'&'.$name[1]['attr_name'].'='.$var_name[1];

                            }catch(\Exception $e){

                            $url = url('details').'/'.$pro->id.'?'.$name[0]['attr_name'].'='.$var_name[0];

                            }

                            @endphp
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="item">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image {{ $orivar->stock ==0 ? "pro-img-box" : ""}}">

                                                    <a href="{{$url}}" title="{{$pro->name}}">

                                                        @if(count($pro->subvariants)>0)

                                                        @if(isset($orivar->variantimages['main_image']))
                                                        <img class="lazy ankit {{ $orivar->stock ==0 ? "filterdimage" : ""}}"
                                                            data-src="{{url('variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}"
                                                            alt="{{$pro->name}}">
                                                        <img class="lazy {{ $orivar->stock ==0 ? "filterdimage" : ""}} hover-image"
                                                            data-src="{{url('variantimages/hoverthumbnail/'.$orivar->variantimages['image2'])}}"
                                                            alt="" />
                                                        @endif

                                                        @else
                                                        <img class="lazy {{ $orivar->stock ==0 ? "filterdimage" : ""}}"
                                                            title="{{ $pro->name }}"
                                                            data-src="{{url('images/no-image.png')}}" alt="No Image" />

                                                        @endif


                                                    </a>
                                                </div>
                                                <!-- /.image -->

                                                @if($orivar->stock == 0)
                                                <h6 align="center" class="oottext">
                                                    <span>{{ __('staticwords.Outofstock') }}</span></h6>
                                                @endif

                                                @if($orivar->stock != 0 && $orivar->products->selling_start_at != null
                                                &&
                                                $orivar->products->selling_start_at >= date('Y-m-d'))
                                                <h6 align="center" class="oottext2">
                                                    <span>{{ __('staticwords.ComingSoon') }}</span></h6>
                                                @endif
                                                <!-- /.image -->

                                                @if($pro->featured=="1")
                                                <div class="tag hot"><span>{{ __('staticwords.Hot') }}</span></div>
                                                @elseif($pro->offer_price != "0")
                                                <div class="tag sale"><span>{{ __('staticwords.Sale') }}</span></div>
                                                @else
                                                <div class="tag new"><span>{{ __('staticwords.New') }}</span></div>
                                                @endif
                                            </div>

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="{{ $url }}">{{$pro->name}}</a></h3>



                                                @php
                                                $reviews = ProductRating::getReview($pro);
                                                @endphp

                                                @if($reviews != 0)


                                                <div class="pull-left">
                                                    <div class="star-ratings-sprite"><span
                                                            style="width:<?php echo $reviews; ?>%"
                                                            class="star-ratings-sprite-rating"></span></div>


                                                    <br>
                                                </div>
                                                @else
                                                <div class="no-rating">{{'No Rating'}}</div>
                                                @endif

                                                <div class="description">

                                                    {{substr(strip_tags($pro->des), 0, 40)}}{{strlen(strip_tags(
                                                                $pro->des))>40 ? '...' : ""}}

                                                </div>

                                                @if($price_login == '0' || Auth::check())

                                                @php

                                                $result = ProductPrice::getprice($pro, $orivar)->getData();

                                                @endphp

                                                <div class="product-price">
                                                    @if($result->offerprice == 0)
                                                    <span class="price"><i
                                                            class="{{session()->get('currency')['value']}}"></i>
                                                        {{ sprintf("%.2f",$result->mainprice*$conversion_rate) }}</span>
                                                    @else
                                                    <span class="price"><i
                                                            class="{{session()->get('currency')['value']}}"></i>{{ sprintf("%.2f",$result->offerprice*$conversion_rate) }}</span>

                                                    <span class="price-before-discount"><i
                                                            class="{{session()->get('currency')['value']}}"></i>{{  sprintf("%.2f",$result->mainprice*$conversion_rate)  }}</span>

                                                    @endif

                                                </div>

                                                @endif
                                                <!-- /.product-price -->

                                            </div>

                                            @if($orivar->products->selling_start_at != null &&
                                            $orivar->products->selling_start_at >=
                                            date('Y-m-d'))
                                            @elseif($orivar->stock < 1) @else <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        @if($price_login != 1 || Auth::check())
                                                        <li id="addCart" class="lnk wishlist">


                                                            <form method="POST"
                                                                action="{{route('add.cart',['id' => $pro->id ,'variantid' =>$orivar->id, 'varprice' => $result->mainprice, 'varofferprice' => $result->offerprice ,'qty' =>$orivar->min_order_qty])}}">
                                                                {{ csrf_field() }}
                                                                <button title="{{ __('Add to Cart') }}" type="submit"
                                                                    class="addtocartcus btn">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                </button>
                                                            </form>



                                                        </li>

                                                        @endif

                                                        @auth
                                                        @if(Auth::user()->wishlist->count()<1) <li class="lnk wishlist">

                                                            <a mainid="{{ $orivar->id }}"
                                                                title="{{ __('staticwords.AddToWishList') }}"
                                                                class="cursor-pointer add-to-cart addtowish"
                                                                data-add="{{url('AddToWishList/'.$orivar->id)}}"
                                                                title="Add to wishlist"> <i
                                                                    class="icon fa fa-heart"></i>
                                                            </a>

                                                            </li>
                                                            @else

                                                            @php
                                                            $ifinwishlist =
                                                            App\Wishlist::where('user_id',Auth::user()->id)->where('pro_id',$orivar->id)->first();
                                                            @endphp

                                                            @if(!empty($ifinwishlist))
                                                            <li class="lnk wishlist active">
                                                                <a mainid="{{ $orivar->id }}"
                                                                    title="{{ __('RemoveFromWishlist') }}"
                                                                    class="cursor-pointer color000 add-to-cart removeFrmWish active"
                                                                    data-remove="{{url('removeWishList/'.$orivar->id)}}"
                                                                    title="Wishlist"> <i class="icon fa fa-heart"></i>
                                                                </a>
                                                            </li>
                                                            @else
                                                            <li class="lnk wishlist"> <a
                                                                    title="{{ __('staticwords.AddToWishList') }}"
                                                                    mainid="{{ $orivar->id }}"
                                                                    class="cursor-pointer text-white add-to-cart addtowish"
                                                                    data-add="{{url('AddToWishList/'.$orivar->id)}}"
                                                                    title="Wishlist"> <i
                                                                        class="activeOne icon fa fa-heart"></i> </a>
                                                            </li>
                                                            @endif

                                                            @endif
                                                            @endauth

                                                            <li class="lnk"> <a class="add-to-cart"
                                                                    href="{{route('compare.product',$orivar->products->id)}}"
                                                                    title="{{ __('staticwords.Compare') }}"> <i
                                                                        class="fa fa-signal" aria-hidden="true"></i>
                                                                </a> </li>
                                                    </ul>
                                                </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif
                    @endforeach
                    @endif

                    @endforeach
                    @else
                    <div class="col-md-12 text-center">
                        <h4>No Products Found !</h4>
                    </div>
                    @endif
                </div>
            </div>

            <div class="tab-pane fade" id="list-container">
                <div class="category-product">
                    <div class="category-product-inner">
                        @if(count($products) > 0)

                        @foreach($products as $key=> $pro)
                        @if($pro->subvariants->count() > 0)
                        @foreach($pro->subvariants as $orivar)
                        @if($orivar->def == '1')
                        @php
                        $var_name_count = count($orivar['main_attr_id']);

                        $name = array();
                        $var_name;
                        $newarr = array();
                        for($i = 0; $i<$var_name_count; $i++){ $var_id=$orivar['main_attr_id'][$i];
                            $var_name[$i]=$orivar['main_attr_value'][$var_id];
                            $name[$i]=App\ProductAttributes::where('id',$var_id)->first();

                            }


                            try{
                            $url =
                            url('details').'/'.$pro->id.'?'.$name[0]['attr_name'].'='.$var_name[0].'&'.$name[1]['attr_name'].'='.$var_name[1];
                            }catch(\Exception $e)
                            {
                            $url = url('details').'/'.$pro->id.'?'.$name[0]['attr_name'].'='.$var_name[0];
                            }
                            @endphp
                            <div class="products">
                                <div class="product-list product">
                                    <div class="row product-list-row">
                                        <div class="col col-sm-3 col-lg-3">
                                            <div class="product-image">
                                                <div class="image {{ $orivar->stock ==0 ? "pro-img-box" : ""}}">

                                                    <a href="{{$url}}" title="{{$pro->name}}">

                                                        @if(count($pro->subvariants)>0)

                                                        @if(isset($orivar->variantimages['main_image']))
                                                        <img style="width:250px;height:200px;object-fit:scale-down;"
                                                            class="lazy img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}"
                                                            data-src="{{url('variantimages/thumbnails/'.$orivar->variantimages['main_image'])}}"
                                                            alt="{{$pro->name}}">

                                                        @endif

                                                        @else
                                                        <img class="lazy img-fluid {{ $orivar->stock ==0 ? "filterdimage" : ""}}"
                                                            title="{{ $pro->name }}"
                                                            data-src="{{url('images/no-image.png')}}" alt="No Image" />

                                                        @endif


                                                    </a>


                                                    <!-- /.image -->

                                                    @if($pro->featured=="1")
                                                    <div class="tag hot"><span>{{ __('staticwords.Hot') }}</span></div>
                                                    @elseif($pro->offer_price != "0")
                                                    <div class="tag sale"><span>{{ __('staticwords.Sale') }}</span>
                                                    </div>
                                                    @else
                                                    <div class="tag new"><span>{{ __('staticwords.New') }}</span></div>
                                                    @endif

                                                </div>

                                                @if($orivar->stock == 0)
                                                <h6 align="center" class="oottext">
                                                    <span>{{ __('staticwords.Outofstock') }}</span></h6>
                                                @endif

                                                @if($orivar->stock != 0 && $orivar->products->selling_start_at != null
                                                &&
                                                $orivar->products->selling_start_at >= date('Y-m-d'))
                                                <h6 align="center" class="oottext2">
                                                    <span>{{ __('staticwords.ComingSoon') }}</span></h6>
                                                @endif
                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col col-sm-9 col-lg-9">
                                            <div class="product-info">
                                                <h3 class="name"><a href="{{ $url }}">{{$pro->name}}</a></h3>
                                                @php
                                                $reviews = ProductRating::getReview($pro);
                                                @endphp

                                                @if($reviews != 0)


                                                <div class="pull-left">
                                                    <div class="star-ratings-sprite"><span
                                                            style="width:<?php echo $reviews; ?>%"
                                                            class="star-ratings-sprite-rating"></span></div>
                                                </div>

                                                <br>
                                                @else
                                                <div class="no-rating">{{'No Rating'}}</div>
                                                @endif

                                                <div class="product-price">
                                                    @if($price_login == '0' || Auth::check())

                                                    @php

                                                    $result = ProductPrice::getprice($pro, $orivar)->getData();

                                                    @endphp


                                                    @if($result->offerprice == 0)
                                                    <span class="price"><i
                                                            class="{{session()->get('currency')['value']}}"></i>
                                                        {{ sprintf("%.2f",$result->mainprice*$conversion_rate) }}</span>
                                                    @else
                                                    <span class="price"><i
                                                            class="{{session()->get('currency')['value']}}"></i>{{ sprintf("%.2f",$result->offerprice*$conversion_rate) }}</span>

                                                    <span class="price-before-discount"><i
                                                            class="{{session()->get('currency')['value']}}"></i>{{  sprintf("%.2f",$result->mainprice*$conversion_rate)  }}</span>

                                                    @endif

                                                    @endif

                                                </div>
                                                <!-- /.product-price -->
                                                <div class="description m-t-10">

                                                    {{substr(strip_tags($pro->des), 0, 250)}}{{strlen(strip_tags(
                                                                    $pro->des))>250 ? '...' : ""}}

                                                </div>


                                                <!-- /.cart -->

                                            </div>
                                            <!-- /.product-info -->

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.product-list -->
                            </div>
                            <hr>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            @else

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4>No Products Found !</h4>
                                </div>
                            </div>

                            @endif
                            <!-- /.products -->
                    </div>
                </div>
            </div>
            <div class="mx-auto" style="width: 200px;">
                {!! $products->appends(Request::except('page'))->links() !!}
            </div>
        </div>

    </div>
    @if($google_reviews != NULL)
        <div id="reviewsgoogle" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="p-2 modal-header">
                        <h5 class="modal-title" id="my-modal-title">{{ __("What customer says about us on google?") }}</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h1 class="text-center">
                            {{$google_reviews['rating']}} <i style="color: #FFC902" class="fa fa-star"></i>

                            <div class="mt-2 clearfix star-ratings-sprite">
                                <span style="width:{{ ($google_reviews['rating']  * 100) / 5 }}%" class="star-ratings-sprite-rating"></span>
                            </div>

                            <h5 class="text-center">
                                {{__("Overall rating")}}
                            </h5>

                        </h1>

                        <ul class="mt-2 list-unstyled">
                            @forelse ($google_reviews['reviews'] as $greview)
                                <li class="shadow-sm mt-2 border p-3 media">
                                    
                                    <img width="64px" src="{{ $greview['profile_photo_url'] }}" class="mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">{{ ucfirst($greview['author_name']) }}</h5>
                                        <div class="float-left clearfix star-ratings-sprite">
                                            <span style="width:{{ ($greview['rating']  * 100) / 5 }}%" class="star-ratings-sprite-rating"></span>
                                        </div>
                                        <br>
                                        <p>{{ $greview['text'] }}</p>
                                    </div>
                                    <small class="float-right">{{ $greview['relative_time_description'] }}</small>
                                </li>
                            @empty
                                
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
@section('script')
<script>
    $(function () {

        "use Strict";

        $('.lazy').lazy({

            effect: "fadeIn",
            effectTime: 1000,
            scrollDirection: 'both',
            threshold: 0

        });
    });
</script>
@endsection