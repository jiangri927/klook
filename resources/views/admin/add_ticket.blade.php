@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
<div class="container">
    <div class="row" style="padding: 40px ;">
        <div class="col-md-12">

            <h5 class="left-br">Your product is {{$product->title}}</h5>
            <h5 class="left-br">Package Name is {{$package->title}}</h5>
            <h2 class="f-bold left-br">Add Ticket to this Package</h2>
            @if(\Illuminate\Support\Facades\Session::get('err_msg'))
            <p class="error-message" role="alert">
                Incorrect Password
            </p>
            @endif
        </div>
        <div class="col-md-12">
            <div class="pr-main">
                <form action="{{route('admin.store.tickets',['package_id'=>$package->id])}}" method="post" id="store_ticket_form">
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
                            <h5>Ticket Title 1</h5>
                            <input type="text" class="form-control" name="title1" placeholder="Please Enter" required>
                            @error('title1')
                            <p class="error-message" role="alert">
                            {{$message}}
                            </p>
                            @enderror
                            <br>
                        </div>
                      
                        <div class="col-md-4">
                            <h5>Market Price 1</h5>
                            <input type="number" class="form-control" name="m_price1" placeholder="Please Enter Number" required step="any">
                        </div>
                        <div class="col-md-4">
                            <h5>Offer Price 1</h5>
                            <input type="number" class="form-control" name="o_price1" placeholder="Please Enter Number" required step="any">
                        </div>
                        <div class="col-md-4">
                            <h5>Offer Percent 1</h5>
                            <input type="number" class="form-control" name="o_percent1" placeholder="Please Enter Number" required step="any">
                            <br>
                        </div>
                        <div class="col-md-4">
                            <h5>ABP Price 1</h5>
                            <input type="number" class="form-control" name="abp_price1" placeholder="Please Enter Number" required step="any">
                        </div>
                        <div class="col-md-4">
                            <h5>ABP Amount 1</h5>
                            <input type="number" class="form-control" name="abp_amount1" placeholder="Please Enter Number" required >
                            <br>
                        </div>
                        <div class="col-md-4">
                            <h5>ABP Percent 1</h5>
                            <input type="number" class="form-control" name="abp_percent1" placeholder="Please Enter Number" required step="any">
                        </div>
                        <input type="text" class="tickets_count" hidden name="counts" value="1">
                        <div class="initial-ticket col-md-12 row" style="margin: 0;padding: 0;">

                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-save add-ticket" href="javascript:void(0);">Add Other Ticket</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-save remove-ticket" href="javascript:void(0);">Reset Ticket</a>
                        </div>
                       
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-save add-package">Save and Add New Package</button>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-save ">Save and Finish Product Setup</button>
                        </div> 
                        
                    </div>
                </form>
            </div>
        </div>


    </div>

</div>
@endsection
@section('additional_js')
<script>
    $(function() {
        
        var product_title = $('.product-title').val();
        var package_title = $('.package-title').val();
        var count = 1;
        $('.add-ticket').on('click', function() {
            count++;
            $('.tickets_count').val(count)
            var element = '<div class="col-md-4 new-ticket-'+count+'"><h5>Product Title</h5><input value="' + product_title + '" class="form-control" disabled></div>' +
                '<div class="col-md-4"><h5>Package Title</h5><input value="' + package_title + '" class="form-control" disabled></div>' +
                '<div class="col-md-4"><h5>Ticket Title ' + count + '</h5><input value="" class="form-control" name="title' + count + '" required><br></div>' +
                '<div class="col-md-4"><h5>Market Price ' + count + '</h5><input type="number" class="form-control" name="m_price' + count + '" placeholder="Please Enter Number" required step="any">' +
                '</div><div class="col-md-4"><h5>Offer Price ' + count + '</h5><input type="number" class="form-control" name="o_price' + count + '" placeholder="Please Enter Number" required step="any">' +
                '</div><div class="col-md-4"><h5>Offer Percent ' + count + '</h5><input type="number" class="form-control" name="o_percent' + count + '" placeholder="Please Enter Number" required step="any">' +
                '<br></div><div class="col-md-4"><h5>ABP Price ' + count + '</h5><input type="number" class="form-control" name="abp_price' + count + '" placeholder="Please Enter Number" required step="any"></div><div class="col-md-4"><h5>ABP Amount  ' + count + '</h5><input type="number" class="form-control" name="abp_amount' + count + '" placeholder="Please Enter Number" required step="any"></div><div class="col-md-4"><h5>ABP Percent ' + count + '</h5><input type="number" class="form-control" name="abp_percent' + count + '" placeholder="Please Enter Number" required><br></div>';


            $('.initial-ticket').append(element);
        });
        $('.remove-ticket').on('click',function(){
            $('.initial-ticket').find('.new-ticket-'+count).parent().empty();
            count--;
        });
        $('.add-package').on('click', function() {
            var element = '<input type="text" name="addNewPk" hidden value="1">'
            $('.initial-ticket').append(element);
            var require_count = $('#store_ticket_form').find('input').length;
            for(var i=0;i<require_count;i++){
                if($('#store_ticket_form').find('input')[i].value === '')
                return;
            }
            $('#store_ticket_form').submit();
        })

    })
</script>
@endsection
