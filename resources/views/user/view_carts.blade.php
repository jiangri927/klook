@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">


@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 40px 15%;">
            <div class="col-md-7">
                <h3 style="color: var(--dark-grey-color)">Added to shopping cart!</h3>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{route('product.show.detail',['product_id'=>$product->id])}}">
                            <img src="{{$product->firstImage->gallery_url}}" alt="" style="width: 100%; border-radius: 10px;height: 100%;">
                        </a>
                    </div>
                    <div class="col-md-9">
                        <h6 style="color: black">Package Type : {{$package->title}}</h6>
                        <h6>Date: {{$cart->date}}</h6>
                        <h6>Quantity:
                            @foreach($tickets as $index=>$item)
                                {{$item->quantity}}
                                <span>x</span>
                                {{$item->ticket_title().','}}
                            @endforeach
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="text-align: right">
                <br><br>
                <h5 style="color: black">Subtotal: S$ {{$cart->total_price}}</h5>
                <br>
                <a href="{{route('home')}}" class="btn btn-save" style="margin-right: 25px; background: white;color: var(--dark-grey-color);border: 1px solid var(--light-grey-color);">Keep Looking</a>
                <a href="" class="btn btn-save">Check Out</a>
            </div>
            <hr>

        </div>
        <div class="row" style="padding: 10px 15%;">
            <div class="col-md-12">
                <h3 style="color: var(--dark-grey-color);">Check our more fun things to do nearby</h3>
            </div>
            @foreach($recommed_product as $item)
                <div class="col-xl-4 col-sm-12 col-md-6 col-lg-4">
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
@endsection
@section('additional_js')

@endsection
