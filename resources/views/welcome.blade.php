@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
@endsection
@section('content')

    <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" style="z-index: -1;">
            @foreach($welcome_gallery as $index=>$item)
                <div class="carousel-item {{$index == 1?'active':''}}">
                    <img class="d-block w-100" src="{{$item->path}}" alt="{{$index}} slide">
                </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="welcome-main-text hidden-xs">
        <div class="col-md-12 text-center">
            <h1 class="text-uppercase ">yours to explore</h1>
            <h3>Discover and book amazing things-to-do at exclusive prices</h3>
            <div class="explore-button">
                <h6>Explore more of Singapore</h6>
                <a href="">Let's Go &nbsp;&nbsp;&nbsp; <span class="fa fa-caret-right"></span></a>
            </div>
        </div>
    </div>
    <div class="welcome-sbox welcome-category" style="margin-top: -50px;">
        <ul class="sbox-ul">
            <li class="sbox-li">
                <img src="{{asset('assets/icons/attractions_shows-6_kfv5zr.png')}}" alt="">
                <h6>All</h6>
            </li>
            <li class="sbox-li">
                <img src="{{asset('assets/icons/attractions_shows-5_jyobkk.png')}}" alt="">
                <h6>Things to do </h6>
            </li>
            <li class="sbox-li">
                <img src="{{asset('assets/icons/attractions_shows_y0oh7h.png')}}" alt="">
                <h6>Hotel</h6>
            </li>
            <li class="sbox-li">
                <img src="{{asset('assets/icons/icon-navigation-s-fnb_v0qnhi.png')}}" alt="">
                <h6>Food & Dining</h6>
            </li>
            <li class="sbox-li">
                <img src="{{asset('assets/icons/attractions_shows-3_v5vm7e.png')}}" alt="">
                <h6>Trains</h6>
            </li>

        </ul>
        <div class="sbox-input">
            <input type="text" class="sbox-text" placeholder="Search by destination , activity">
            <button class="sbox-btn">Search</button>
        </div>
    </div>
    <div class="paypal-button-container" style="text-align: center;"></div>
    {{--<div class="welcome-sbox product-view">--}}
        {{--<h4 style="font-weight: bold;">Destinations Travellers Love</h4>--}}
        {{--<div class="row">--}}
            {{--@foreach($main_dest as $item)--}}
                {{--<div class="col-xl-3 col-sm-12 col-md-6 col-lg-4">--}}
                    {{--<div class="p-act">--}}
                        {{--<a href="">--}}
                            {{--<div class="act-image text-center" style="background: url({{$item->indexImage()?$item->indexImage()->path:''}});height: 275px; ">--}}
                                {{--<h6 class="dest-title">{{$item->title}}</h6>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="welcome-sbox product-view">
        <h4 style="font-weight: bold;">Activities Travellers Love</h4>
        <div class="row">
            @foreach($love_product as $item)
                <div class="col-xl-3 col-sm-12 col-md-6 col-lg-4">
                    <div class="p-act">
                        <a href="{{route('product.show.detail',['product_id'=>$item->id])}}">
                            <div class="act-image" style="background: url({{$item->firstImage?$item->firstImage->gallery_url:''}})">
                            </div>
                            <div class="act-info">
                                <h6 class="h6-title">{{$item->title}}</h6>
                                <h6>284 reviews | 4K + Booked</h6>
                                <h6 class="old-pr">S$ {{$item->firstPackage->firstTicket?$item->firstPackage->firstTicket->m_price:''}}</h6>
                                <h6 class="cu-pr">S$ {{$item->firstPackage->firstTicket?$item->firstPackage->firstTicket->o_price:''}}</h6>
                                <h6>Available from {{$item->firstPackage->firstTicket?$item->firstPackage->available_date():''}}</h6>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="welcome-sbox product-view">
        <h4 style="font-weight: bold;">Travelooker Recommended</h4>
        <div class="row">
            @foreach($recommed_product as $item)
                <div class="col-xl-3 col-sm-12 col-md-6 col-lg-4">
                    <div class="p-act">
                        <a href="{{route('product.show.detail',['product_id'=>$item->id])}}">
                            <div class="act-image" style="background: url({{$item->firstImage?$item->firstImage->gallery_url:''}})">
                            </div>
                            <div class="act-info">
                                <h6 class="h6-title">{{$item->title}}</h6>
                                <h6>284 reviews | 4K + Booked</h6>
                                <h6 class="old-pr">S$ {{$item->firstPackage->firstTicket?$item->firstPackage->firstTicket->m_price:''}}</h6>
                                <h6 class="cu-pr">S$ {{$item->firstPackage->firstTicket?$item->firstPackage->firstTicket->o_price:''}}</h6>
                                <h6>Available from {{$item->firstPackage->firstTicket?$item->firstPackage->available_date():''}}</h6>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- <div class="container mg_50">
        <div class="section_title text-left">
            <h2 class="nb-singa">Nearby Singapore</h2>
            <a href="{{route('product.show.detail',['product_id'=>1])}}">Click this</a>
        </div>
        <div class="row mb_30">
            <div class="col-lg-3 col-sm-6">
                <div class="accomodation_item ">
                    <div class="hotel_img">
                        <img src="https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/vn4t31wuqx6qnqjmmw11.webp" alt="">
                    </div>
                    <div class="hotel_info">
                        <h6 style="color:#fe6473 ">133m from you</h6>
                        <h6 style="color:#3b3c3d ">Wooloomooloo Steakhouse at Swissotel The Stamford</h6>
                        <h6 style="color: grey;">100+ Booked</h6>
                        <h6 style="color:black;margin-top: 5px;">S$ 45.00</h6>
                        <h6 style="color: grey;">Available Today</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="accomodation_item ">
                    <div class="hotel_img">
                        <img src="https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/vn4t31wuqx6qnqjmmw11.webp" alt="">
                    </div>
                    <div class="hotel_info">
                        <h6 style="color:#fe6473 ">133m from you</h6>
                        <h6 style="color:#3b3c3d ">Wooloomooloo Steakhouse at Swissotel The Stamford</h6>
                        <h6 style="color: grey;">100+ Booked</h6>
                        <h6 style="color:black;margin-top: 5px;">S$ 45.00</h6>
                        <h6 style="color: grey;">Available Today</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="accomodation_item ">
                    <div class="hotel_img">
                        <img src="https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/vn4t31wuqx6qnqjmmw11.webp" alt="">
                    </div>
                    <div class="hotel_info">
                        <h6 style="color:#fe6473 ">133m from you</h6>
                        <h6 style="color:#3b3c3d ">Wooloomooloo Steakhouse at Swissotel The Stamford</h6>
                        <h6 style="color: grey;">100+ Booked</h6>
                        <h6 style="color:black;margin-top: 5px;">S$ 45.00</h6>
                        <h6 style="color: grey;">Available Today</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="accomodation_item ">
                    <div class="hotel_img">
                        <img src="https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/vn4t31wuqx6qnqjmmw11.webp" alt="">
                    </div>
                    <div class="hotel_info">
                        <h6 style="color:#fe6473 ">133m from you</h6>
                        <h6 style="color:#3b3c3d ">Wooloomooloo Steakhouse at Swissotel The Stamford</h6>
                        <h6 style="color: grey;">100+ Booked</h6>
                        <h6 style="color:black;margin-top: 5px;">S$ 45.00</h6>
                        <h6 style="color: grey;">Available Today</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="v-all">
            <a href="" class="view-all">View All</a>
        </div>
    </div>
    <div class="container mg_50 bg-white">
        <div class="section_title text-left">
            <h2 class="nb-singa">Popular Destinations</h2>

        </div>
        <div class="row mb_30">
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                <div class="p-dest">
                    <h2 class="text-uppercase">singapore</h2>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                <div class="p-dest" style="background: url('https://res.klook.com/image/upload/c_fill,w_352,h_470/fl_lossy.progressive,q_85,f_auto////banner/dn9yn52hhksxbh4fwfdv.webp')">
                    <h2 class="text-uppercase">new zealand</h2>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                <div class="p-dest" style="background: url('https://res.klook.com/image/upload/c_fill,w_352,h_470/fl_lossy.progressive,q_85,f_auto////cities/dfmgdybv6xkvl0kxzzzp.webp')">
                    <h2 class="text-uppercase">kuala lumpur</h2>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                <div class="p-dest" style="background: url('https://res.klook.com/image/upload/c_fill,w_352,h_470/fl_lossy.progressive,q_85,f_auto////cities/gt3epxrraizwpzhuwq7r.webp')">
                    <h2 class="text-uppercase">tokyo</h2>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                <div class="p-dest" style="background: url(https://res.klook.com/image/upload/c_fill,w_352,h_470/fl_lossy.progressive,q_85,f_auto////cities/dpvmevbgwib3wiyzgpty.webp)">
                    <h2 class="text-uppercase">batam</h2>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                <div class="p-dest" style="background: url('https://res.klook.com/image/upload/c_fill,w_352,h_470/fl_lossy.progressive,q_85,f_auto////cities/lpzdjplzvzvvnhkczuy4.webp')">
                    <h2 class="text-uppercase">bintan</h2>
                </div>
            </div>
        </div>
        <div class="v-all">
            <a href="" class="view-all">Explore all destinations</a>
        </div>
    </div>
    <div class="container mg_50 bg-white">
        <div class="section_title text-left">
            <h2 class="nb-singa">Popular Activities</h2>

        </div>
        <div class="row mb_30">
            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
                <div class="p-act">
                    <div class="act-image" style="background: url(https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/p6a8mczmhyk6qq6cogxq.webp)">
                        <div class="act-btn">
                            <a href="">Bestseller</a>
                            <a href="" class="off-btn">10% OFF</a>
                        </div>
                    </div>
                    <div class="act-info">
                        <h6 class="h6-title">Atmosphere 360 Revolving Restaurant in KL Tower</h6>
                        <h6>284 reviews | 4K + Booked</h6>
                        <h6 class="old-pr">S$ 19.00</h6>
                        <h6 class="cu-pr">S$ 17.19</h6>
                        <h6>Available from 14 Sep 2020</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
                <div class="p-act">
                    <div class="act-image" style="background: url('https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/o7dl8ray4ofbzasicp0d.webp')">
                        <div class="act-btn">
                            <a href="">Bestseller</a>
                            <a href="" class="off-btn">10% OFF</a>
                        </div>
                    </div>
                    <div class="act-info">
                        <h6 class="h6-title">Aquaria KLCC Ticket in Kuala Lumpur (QR Code Direct Entry)</h6>
                        <h6>284 reviews | 4K + Booked</h6>
                        <h6 class="old-pr">S$ 19.00</h6>
                        <h6 class="cu-pr">S$ 17.19</h6>
                        <h6>Available from 14 Sep 2020</h6>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
                <div class="p-act">
                    <div class="act-image" style="background: url('https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/rfquomn0fq1rxp9h6dwn.webp')">
                        <div class="act-btn">
                            <a href="">Bestseller</a>
                            <a href="" class="off-btn">10% OFF</a>
                        </div>
                    </div>
                    <div class="act-info">
                        <h6 class="h6-title">Atmosphere 360 Revolving Restaurant in KL Tower</h6>
                        <h6>284 reviews | 4K + Booked</h6>
                        <h6 class="old-pr">S$ 19.00</h6>
                        <h6 class="cu-pr">S$ 17.19</h6>
                        <h6>Available from 14 Sep 2020</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
                <div class="p-act">
                    <div class="act-image" style="background: url('https://res.klook.com/image/upload/c_fill,w_550,h_308/fl_lossy.progressive,q_85,f_auto////activities/csfmo8rpscwkgkagd9ir.webp')">
                        <div class="act-btn">
                            <a href="">Bestseller</a>
                            <a href="" class="off-btn">10% OFF</a>
                        </div>
                    </div>
                    <div class="act-info">
                        <h6 class="h6-title">Atmosphere 360 Revolving Restaurant in KL Tower</h6>
                        <h6>284 reviews | 4K + Booked</h6>
                        <h6 class="old-pr">S$ 19.00</h6>
                        <h6 class="cu-pr">S$ 17.19</h6>
                        <h6>Available from 14 Sep 2020</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="v-all">
            <a href="" class="view-all">View All</a>
        </div>
    </div> -->
@endsection

