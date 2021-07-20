@extends('layouts.app')
@section('additional_css')
<link rel="stylesheet" href="{{asset('css/product.css')}}">
<style>
    .qty {
        width: 120px;
    }

    .qty .count {
        color: #000;
        display: inline-block;
        vertical-align: top;
        font-size: 25px;
        font-weight: 700;
        line-height: 30px;
        padding: 0 2px;
        min-width: 35px;
        text-align: center;
    }

    .qty .plus {
        cursor: pointer;
        display: inline-block;
        vertical-align: top;
        color: white;
        width: 30px;
        height: 30px;
        font: 30px/1 Arial, sans-serif;
        text-align: center;
        border-radius: 50%;
    }

    .qty .minus {
        cursor: pointer;
        display: inline-block;
        vertical-align: top;
        color: white;
        width: 30px;
        height: 30px;
        font: 30px/1 Arial, sans-serif;
        text-align: center;
        border-radius: 50%;
        background-clip: padding-box;
    }

    /*div {*/
    /*text-align: center;*/
    /*}*/
    .minus:hover {
        background-color: #717fe0 !important;
    }

    .plus:hover {
        background-color: #717fe0 !important;
    }

    /*Prevent text selection*/
    span {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    input {
        border: 0;
        width: 2%;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input:disabled {
        background-color: white;
    }
</style>
@endsection
@section('content')
<div class="container " style="padding: 40px 100px;background: white">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($product_gallery as $index=>$gallery)
            <div class="carousel-item text-center {{$index==1?'active':''}}">
                <img class="" src="{{$gallery->gallery_url}}" alt="Next slide" style="width: 100%;height: 450px;">
            </div>
            @endforeach

        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="route" style="padding: 25px 0;">
                <a href="">Home > </a><a href="">{{$product->country}} > </a><a href="">{{$product->city}} > </a><a href="">{{$product->category}} > </a><a href="">{{$product->subcategory}} > </a>
            </div>
            <div class="product-info">
                <h2 class="pr-title">{{$product->title}}</h2>
                <div class="pr-review"><span class="fa fa-star" style="color: #ffa628;"></span>
                    <p style="color: #ffa628;">4.8</p>
                    <p style="color: var(--blue-color)">(22,869 reviews) | </p>
                    <p>400K + Booked</p> <span class="fa fa-heart-o" style="margin-left: auto;">&nbsp;&nbsp;Wishlist</span>
                </div>
                <hr>
                <p><?php echo $product->info ?></p>
                <hr>
            </div>
        </div>
        <div class="col-md-4" style="padding: 25px;">
            <div class="pr-pick-option">
                <div style="display: flex;">
                    <div class="tk-save text-center">
                        <h6>Save</h6>
                        <h6>{{$product->firstPackage->firstTicket->o_percent}}%</h6>
                    </div>
                    <div style="padding: 0 10px;">
                        <h6>Travelooker Price Guarantee</h6>
                        <div style="display: flex;align-items: center;">
                            <h2>RM {{$product->firstPackage->firstTicket->o_price}}</h2>
                            <h4 style="text-decoration: line-through">{{$product->firstPackage->firstTicket->m_price}}</h4>
                        </div>
                    </div>
                </div>
                <button class="btn btn-save pick-button" style="margin-top: 12px;">Order & Pick your option</button>
            </div>
        </div>
    </div>
    <div class="row">
            <h2 class="pr-title left-br scroll-to-package" style="margin: 15px;width:100%">{{$product->title}} Package Options</h2>
        <div class="col-md-8">
            <div class="package-info">
                <h4 style="font-weight: 500">Select date and package options</h4>
                <p class="package-des">Please select a visit date</p>
                <span class="fa fa-calendar check-date" data-set=false>&nbsp;&nbsp;&nbsp;Check Availability</span>
                <p class="package-des">Package Type</p>
                <div class="package-box" style="margin: 0;">
                    @foreach($package as $index=>$item )
                    <button class="package-type {{$index==0?'package-active':''}}" data-id="{{$item->id}}">{{$item->title}}</button>
                    @endforeach
                </div>
                <p class="package-des">Quantity</p>
                <div class="ticket-detail">
                    @foreach($product->firstPackage->tickets as $item)
                    <div class="book-section">
                        <h5 style="margin-right:  auto">{{$item->title}}</h5>
                        <h5 style="text-decoration: line-through;margin: 0 10px">S$ {{$item->m_price}}</h5>
                        <h4 style="color: var(--blue-color);margin: 0 10px;" id="ticket-o-price" >S$ {{$item->o_price}}</h4>
                        <div class="qty">
                            <span class="minus bg-dark">-</span>
                            <input type="order_number" class="count" name="qty" value="1">
                            <span class="plus bg-dark">+</span>
                        </div>
                    </div>
                    @endforeach
                    
                </div>


                <p class="package-des">Amount Details</p>
                <div class="row">
                    <div class="col-md-6">
                        <h3 style="color: var(--blue-color);margin: 0;" class="amount-detail"></h3>
                        <p>Complete this activity to get 107 Credits!</p>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-success " href="javascript:void(0);" id="add-cart" style="color: white" >Add to cart</a>
                        <button class="btn btn-info" style="background: var(--red-color);margin-left: 20px" id="book-button">Book Now</button>
                    </div>
                    <form action="{{route('user.add.cart')}}" method="post" id="add-cart-form" hidden>
                        @csrf
                    </form>
                    <form action="{{route('user.book.prepare')}}" method="post" id="book-prepare-button" hidden>
                        @csrf
                    </form>
                </div>
                <div class="paypal-button-container" style="text-align: center;"></div>
            </div>
        </div>
        <div class="col-md-4" style="padding: 0 40px;">
            <div class="package-info" style="padding: 20px;">
                <h4 style="font-weight: 500">Selected package details</h4>
                <a href="javascript:void(0);" id="pk_detail">Package Description |</a>
                <a href="javascript:void(0);" id="pk_terms">Terms & Conditions |</a>
                <a href="javascript:void(0);" id="pk_guide">How To Use</a>
                <br>
                <div class="pk-detail-box" style="height: 500px;overflow: scroll;padding: 10px;">
                    <div class="things_to pk-info"><?php echo $package[0]->info ?></div>
                    <div class="things_to pk-detail" style="padding: 15px 0;">
                        <h2>Package Description</h2><?php echo $package[0]->description ?>
                    </div>
                    <div class="things_to pk-terms" style="padding: 15px 0;">
                        <h2>Terms & Conditions</h2><?php echo $package[0]->terms ?>
                    </div>
                    <div class="things_to pk-guide" style="padding: 15px 0;">
                        <h2>How To use</h2><?php echo $package[0]->guide ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <div class="row things_to">
                <?php echo  $product->look_for ? $product->look_for . '<hr>' : '' ?>
            </div>
            <div class="row things_to">
                <?php echo  $product->things ? $product->things .'<hr>': '' ?>
            </div>
            
            <div class="row things_to">
                <?php echo  $product->faq ? $product->faq . '<hr>' : '' ?>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('additional_js')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="{{ asset('js/booking.js') }}"></script>
<script>
    var get_ticket_detail = '{{route("get.ticket.detail")}}';
    var available_package_url = '{{ route("get.available.package") }}';
    var available_dates_url = '{{ route("get.available.dates") }}';
    var product_id = '{{ $product->id }}';
</script>

@endsection
