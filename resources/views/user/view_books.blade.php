@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <style>
        .step-contact p{
            margin: 0;
            font-size: 11px;
            color: black;
        }
        .pay-right p{
            margin: 0;
        }
        .step-contact h5,h6{
            margin: 0;
        }
    </style>

@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 40px 12%;">
            <div class="col-md-8" >
                <div class="pay-left" style="background: white;padding: 0;">
                    <h4 class="step-1" style="padding: 10px 20px;color: var(--red-color);border-bottom: 1px solid lightgrey;margin: 0;font-weight: 400">Step 1: Fill in traveler information
                        <span class="step-1-dropdown" style="float:right;font-size: 14px;cursor:pointer;display: none;color: #16aa77;">View Details</span>
                    </h4>
                    <div class="step-contact" style="padding: 20px;">
                        <h6 style="border: 1px solid #ffe9a8;background:#fff7e0;color: var(--red-color);padding: 5px 10px;">
                            Please be careful when filling in your info as you might not be able to change it later.
                        </h6>
                        <br>
                        <h4 class="left-br">Contact Information</h4>
                        <p>We will notify you of any changes to your booking</p>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <p>Title</p>
                                <select name="title" id="" class="form-control" >
                                    <option value="0">Please Select</option>
                                    <option value="Mr" {{$user->title=='Mr'?'selected':''}}>Mr</option>
                                    <option value="MRS" {{$user->title=='MRS'?'selected':''}}>MRS</option>
                                    <option value="MISS" {{$user->title=='MISS'?'selected':''}}>MISS</option>
                                </select>
                                <br>
                            </div>
                            <div class="col-md-5">
                                <p>First Name (as on Travel Document)</p>
                                <input type="text" name="first_name" placeholder="Please Enter" class="form-control" value="{{$user->first_name}}">
                                <br>
                            </div>
                            <div class="col-md-5">
                                <p>Family Name (as on Travel Document)</p>
                                <input type="text" name="second_name" placeholder="Please Enter" class="form-control" value="{{$user->second_name}}">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Country/Region of Travel Document</p>
                                <select name="country" id="" class="form-control">
                                    <option value="0">Please Select</option>
                                    @foreach($country as $item)
                                        <option value="{{$item->name}}" {{$user->country==$item->name?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Country/region code</p>
                                <select name="countrycode" id="" class="form-control">
                                    <option value="0">Please Select</option>
                                    @foreach($country as $item)
                                        <option value="{{$item->phonecode}}" {{$user->countryCode == $item->phonecode?'selected':''}}>{{$item->name.' +('.$item->phonecode.')'}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <p>Phone number (In case of emergency)</p>
                                <input type="text" name="number" placeholder="Please Enter" class="form-control" value="{{$user->number}}">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Email address(We will send your voucher to this address)</p>
                                <input type="text" name="email" placeholder="Please Enter" class="form-control" value="{{$user->email}}">
                                <br>
                            </div>
                        </div>
                        <h4 class="left-br">Promo codes</h4>
                        <button class="btn btn-success">Use Promo Code</button>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <p>Your booking will be submitted once you click "Book now". You can choose your payment method on the next page</p>
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0);" class="btn admin-action step-contact-complete" style="background:var(--red-color) ">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"  >
                <div class="pay-right" style="background: white;padding: 20px;margin-bottom: 20px">
                    <p style="color: var(--dark-grey-color);font-weight: 400">{{$book->product}}</p>
                    <p>{{$book->package}}</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <p>Date</p>
                        </div>
                        <div class="col-md-7 text-right">
                            <p style="color: black;font-size: 12px">{{$book->date}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p>Quantity</p>
                        </div>
                        <div class="col-md-7 text-right">
                            @foreach($tickets as $item)
                                <p style="color: black;font-size: 12px">{{$item->quantity}} x {{$item->ticket_title()}}</p>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Total</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p style="color: black;font-weight: 900;">RM {{$book->total_price}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="margin-top: 25px;" >
                <div class="pay-left" style="background: white;padding: 0;">
                    <h4 class="step-2" style="padding: 10px 20px;color: lightgrey;border-bottom: 1px solid lightgrey;margin: 0;font-weight: 400">Step 2: Complete payment<span class="step-2-count" style="float:right;font-size: 15px;display: none;">Payment within</span>
                    </h4>
                    <div class="step-payment" style="padding: 20px;display: none;">
                        <h6 style="border: 1px solid #ffe9a8;background:#e6efff;color: #346bd1;padding: 5px 10px;">
                            All card information is fully encrypted, secure, and protected
                        </h6>
                        <br>
                        <div class="row ">
                            <div class="col-md-8" style="margin: auto;">
                                <h6 style="background-color: lightgrey;width: 100%;padding: 10px;">Payment Summary</h6>
                                <div class="" style="display: flex;padding: 10px; border-bottom: 1px solid lightgrey;">
                                    <h6>Subtotal</h6>
                                    <h6 style="color: black;margin-left: auto;">RM {{$book->total_price}}</h6>
                                </div>
                                <div class="" style="display: flex;padding: 10px;">
                                    <h6>Use Promo Code</h6>
                                    <h6 style="color: black;margin-left: auto;">></h6>
                                </div>
                                <div class="" style="display: flex;padding: 10px; align-items: baseline">
                                    <h6>Travelooker ABP</h6>
                                    <div class="" style="margin-left: auto">
                                        <h6 id="abp-to-credit" style="display: none;">- RM {{$user->abp > $total_abp ? $total_abp/2.5:$user->abp/2.5}}</h6>
                                        <h6 id="abp1">Total ABP {{$total_abp}}</h6>
                                        <h6 id="abp2">Usable ABP {{$user->abp > $total_abp ? $total_abp:$user->abp}}</h6>
                                    </div>
                                    <input type="checkbox" name="kind" style="margin-left: 10px;">

                                </div>
                                <hr>

                                <div class="" style="display: flex;padding: 10px;align-items: center">
                                    <h6 style="margin-left: auto;">Total</h6>
                                    <h5 style="color: var(--red-color);font-weight: 500;margin-left: 15px;margin-bottom: 0;" id="real-price1" >RM {{$book->total_price}}</h5>
                                    <h5 style="color: var(--red-color);font-weight: 500;margin-left: 15px;margin-bottom: 0;display: none;" id="real-price2" >
                                        RM {{$user->abp > $total_abp ? $book->total_price-$total_abp/2.5: $book->total_price-$user->abp/2.5}}</h5>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="paypal-button-container" style="display: none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="margin-top: 25px;">
                <div class="pay-left" style="background: white;padding: 0;">
                    <div class="step-pay" style="padding: 20px;display: none;">
                        <div class="row">
                            <div class="col-md-9">
                                <br>
                                <p style="font-size: 13px">By clicking Pay now, you agree that you have read and understood our Terms & Conditions and Cancellation policy</p>
                            </div>
                            <div class="col-md-3 text-center">
                                <h5 style="color: #ff5722" id="real-price3">RM {{$book->total_price}}</h5>
                                <h5 style="color: #ff5722;display: none;" id="real-price4" >
                                    RM {{$user->abp > $total_abp ? $book->total_price-$total_abp/2.5: $book->total_price-$user->abp/2.5}}</h5>
                                <a href="javascript:void(0);" class="pay-now btn admin-action" style="background: #ff5722;color: white;" data-id="{{$book->id}}" data-price="{{$book->total_price-$user->credits}}" data-price1="{{$book->total_price-$user->credits+$total_abp/2.5}}">Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('additional_js')
    <script src="https://www.paypal.com/sdk/js?client-id=ASOwer7apGF_mcaOtZAnzOqmy2Igy4RKowFrM6f9ouV_Bt_yMcECw2RejP-EXF9sKktFAaxcO0MAudze&currency=MYR"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>

    <script>
        var pay_return_url ='{{ route('paypal.success')}}';
        var pay_credits_url ='{{ route('pay.credits.success')}}';
        var tick = 'off';
        $(function () {
            $('.step-contact-complete').on('click',function () {
                // var element = $('.step-1');
                // element.style()
                $('.step-1').css('color','#16aa77');
                $('.step-1').css('background','#e9f8f1');
                $('.step-1-dropdown').css('display','block');
                $('.step-contact').hide();
                $('.step-2').css('color','#ff5722');
                $('.step-2-count').show();
                $('.step-payment').show();
                $('.step-pay').show();
            });
            $('.step-1-dropdown').on('click',function () {
                $('.step-contact').show();
            });
            $(document).on('change','[name=kind]',function () {
               if (tick == 'off'){
                   tick ='on';
                   $('#abp-to-credit').show();
                   $('#abp1').hide();
                   $('#abp2').hide();
                   $('#real-price1').hide();
                   $('#real-price2').show();
                   $('#real-price3').hide();
                   $('#real-price4').show();
               }
               else{
                   tick='off';
                   $('#abp-to-credit').hide();
                   $('#abp1').show();
                   $('#abp2').show();
                   $('#real-price2').hide();
                   $('#real-price1').show();
                   $('#real-price4').hide();
                   $('#real-price3').show();

               }
            });
            $('.pay-now').on('click',function () {

                if (tick === 'off'){
                    var price = $(this).data('price');
                    var id = $(this).data('id');
                    if (price > 0){

                        $('.paypal-button-container').empty();
                        $('.paypal-button-container').show();
                        let user_id = $(this).data('id');
                        paypal.Buttons({
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value:price
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {

                                return actions.order.capture().then(function(details) {
                                    $(function () {
                                        $.ajax({
                                            url: pay_return_url,
                                            type: "get",
                                            datatype: "json",
                                            data: {'id':id, _token: $("meta[name='csrf-token']").attr("content"),'kind':'only'},
                                            success: function (data) {
                                                location.href = '/'
                                            }
                                        });
                                    })
                                });
                            }
                        }).render('.paypal-button-container');
                    }
                    else{
                        $.ajax({
                            url: pay_credits_url,
                            type: "get",
                            datatype: "json",
                            data: {'id':id, _token: $("meta[name='csrf-token']").attr("content"),'kind':'only'},
                            success: function (data) {
                                location.href = '/'
                            }
                        });
                    }
                }
                else {
                    var id = $(this).data('id');
                    var price1 = $(this).data('price1');
                    console.log(price1);
                    if (price1 > 0){

                        $('.paypal-button-container').empty();
                        $('.paypal-button-container').show();
                        let user_id = $(this).data('id');
                        paypal.Buttons({
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value:price1
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {

                                return actions.order.capture().then(function(details) {
                                    $(function () {
                                        $.ajax({
                                            url: pay_return_url,
                                            type: "get",
                                            datatype: "json",
                                            data: {'id':id, _token: $("meta[name='csrf-token']").attr("content")},
                                            success: function (data) {
                                                location.href = '/'
                                            }
                                        });
                                    })
                                });
                            }
                        }).render('.paypal-button-container');
                    }
                    else{
                        $.ajax({
                            url: pay_credits_url,
                            type: "get",
                            datatype: "json",
                            data: {'id':id, _token: $("meta[name='csrf-token']").attr("content")},
                            success: function (data) {
                                location.href = '/'
                            }
                        });
                    }
                }

            })
        })
    </script>
@endsection
