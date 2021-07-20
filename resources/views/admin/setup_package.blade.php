
@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">
                <h5 class="left-br">Your product is {{$product->title}}</h5>
                <h2 class="f-bold left-br">Add New Package</h2>
            </div>
            <div class="col-md-12">
                <div class="pr-main">
                    <form action="{{route('admin.store.package',['product_id'=>$product->id])}}" method="post" id="setup_package_form">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 ">
                                <h5>Product Title</h5>
                                <input type="text" class="form-control" disabled value="{{$product->title}}">
                            </div>
                            <div class="col-md-6 ">
                                <h5>Package Title</h5>
                                <input type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Please Enter" name="title" value="{{old('title')}}">
                                @error('title')
                                <p class="error-message" role="alert">
                                {{$message}}
                                 </p>
                                @enderror
                                <br>
                            </div>

                            <div class="col-md-6">
                                <h5>Package Information</h5>
                                <textarea name="info" id="info-text" cols="30" rows="10">
                                    {{old('info')}}
                                </textarea>
                                @error('info')
                                <p class="error-message" role="alert">
                                {{$message}}
                                 </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Package Description</h5>
                                <textarea name="description" id="description-text" cols="30" rows="10">
                                {{old('description')}}
                                </textarea>
                                @error('description')
                                <p class="error-message" role="alert">
                                {{$message}}
                                 </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Package Terms</h5>
                                <textarea name="terms" id="term-text" cols="30" rows="10">
                                {{old('terms')}}
                                </textarea>
                                @error('terms')
                                <p class="error-message" role="alert">
                                {{$message}}
                                 </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Package Guide</h5>
                                <textarea name="guide" id="guide-text" cols="30" rows="10">
                                {{old('guide')}}
                                </textarea>
                                @error('guide')
                                <p class="error-message" role="alert">
                                {{$message}}
                                 </p>
                                @enderror
                                <br>
                            </div>
                            <input type="text" name="availability" id="availability" hidden>
                            <div class="col-md-4">
                                <h5>Select Available Days</h5>
                                <input type="text" name="" id="datepicker" placeholder="Please Enter" class="form-control @error('availability') is-invalid @enderror">
                                @error('availability')
                                <p class="error-message" role="alert">
                                {{$message}}
                                 </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-8 av-dates row">

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-save" type="submit" >Save and Add Ticket</button>
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
        CKEDITOR.replace( 'description-text');
        CKEDITOR.replace( 'info-text');
        CKEDITOR.replace( 'term-text');
        CKEDITOR.replace( 'guide-text');
    </script>
    <script src="{{asset('js/package.js')}}"></script>
    <script type="text/javascript">
        // Maintain array of dates
        var dates = new Array();

        function addDate(date) {
            if (jQuery.inArray(date, dates) < 0)
                dates.push(date);
        }

        function removeDate(index) {
            dates.splice(index, 1);
        }

        // Adds a date if we don't have it yet, else remove it
        function addOrRemoveDate(date) {
            $('.av-dates').empty();
            var index = jQuery.inArray(date, dates);
            if (index >= 0)
                removeDate(index);
            else
                addDate(date);
            $('#availability').val(dates);
            for (var i=0;i<dates.length;i++){
                $('.av-dates').append('<p class="date-display">'+dates[i]+'</p>');
            }
        }


        // Takes a 1-digit number and inserts a zero before it
        function padNumber(number) {
            var ret = new String(number);
            if (ret.length == 1)
                ret = "0" + ret;
            return ret;
        }

        jQuery(function () {
            jQuery("#datepicker").datepicker({
                minDate: new Date(),
                onSelect: function (dateText, inst) {
                    $(this).data('datepicker').inline = true;
                    addOrRemoveDate(dateText);
                },
                onClose: function() {
                    $(this).data('datepicker').inline = false;
                },
                beforeShowDay: function (date) {
                    var year = date.getFullYear();
                    // months and days are inserted into the array in the form, e.g "01/01/2009", but here the format is "1/1/2009"
                    var month = padNumber(date.getMonth() + 1);
                    var day = padNumber(date.getDate());
                    // This depends on the datepicker's date format
                    var dateString = month + "/" + day + "/" + year;

                    var gotDate = jQuery.inArray(dateString, dates);
                    if (gotDate >= 0) {
                        // Enable date so it can be deselected. Set style to be highlighted
                        return [true, "ui-state-highlight"];
                    }
                    // Dates not in the array are left enabled, but with no extra style
                    return [true, ""];
                }
            });
        });
    </script>
@endsection
