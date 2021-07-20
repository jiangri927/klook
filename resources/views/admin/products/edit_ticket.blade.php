@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">

                <h5 class="left-br">Your product is {{$product->title}}</h5>
                <h5 class="left-br">Package Name is {{$package->title}}</h5>
                <h2 class="f-bold left-br">Edit Ticket</h2>

            </div>
            <div class="col-md-12">
                <div class="pr-main">
                    <form action="{{route('admin.change.tickets',['ticket_id'=>$ticket->id])}}" method="post" id="store_ticket_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Product Title</h5>
                                <input type="text" class="form-control product-title" value="{{$product->title}}" disabled>
                            </div>
                            <div class="col-md-4">
                                <h5>Package Title</h5>
                                <input type="text" class="form-control package-title" value="{{$package->title}}" disabled>
                            </div>
                            <div class="col-md-4">
                                <h5>Ticket Title </h5>
                                <input type="text" class="form-control" name="title" placeholder="Please Enter" value="{{$ticket->title}}" required>
                                @error('title1')
                                <p class="error-message" role="alert">
                                    {{$message}}
                                </p>
                                @enderror
                                <br>
                            </div>

                            <div class="col-md-4">
                                <h5>Market Price </h5>
                                <input type="number" class="form-control" name="m_price" placeholder="Please Enter Number" value="{{$ticket->m_price}}" required step="any">
                            </div>
                            <div class="col-md-4">
                                <h5>Offer Price </h5>
                                <input type="number" class="form-control" name="o_price" placeholder="Please Enter Number" value="{{$ticket->o_price}}" required step="any">
                            </div>
                            <div class="col-md-4">
                                <h5>Offer Percent </h5>
                                <input type="number" class="form-control" name="o_percent" placeholder="Please Enter Number" value="{{$ticket->o_percent}}" required step="any">
                                <br>
                            </div>
                            <div class="col-md-4">
                                <h5>ABP Price </h5>
                                <input type="number" class="form-control" name="abp_price" placeholder="Please Enter Number" value="{{$ticket->abp_price}}" required step="any">
                            </div>
                            <div class="col-md-4">
                                <h5>ABP Amount </h5>
                                <input type="number" class="form-control" name="abp_amount" placeholder="Please Enter Number" value="{{$ticket->abp_amount}}" required >
                                <br>
                            </div>
                            <div class="col-md-4">
                                <h5>ABP Percent </h5>
                                <input type="number" class="form-control" name="abp_percent" placeholder="Please Enter Number" value="{{$ticket->abp_percent}}" required step="any">
                            </div>


                            <div class="col-md-6">
                                <button type="submit" class="btn btn-save add-package">Save Ticket</button>
                            </div>


                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
@endsection

