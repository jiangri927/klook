@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">

    <style type="text/css">div#ui-datepicker-div.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{z-index: 2222 !important;}</style>

@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding: 40px 0;">
            @include('user.sidebar')
            @include('user.'.$active)
        </div>
    </div>
@endsection
@section('additional_js')
{{--    <script src="{{asset('js/app.js')}}"></script>--}}
    <script>
        $(function () {
            var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
            Dropzone.autoDiscover = false;
            avatar_upload = new Dropzone("#pr-avatar-upload",{
                maxFilesize: 1,
                dataType: 'json',
                init:function () {
                    this.on('complete',function (file) {
                        this.removeFile(file);
                    });
                    this.on('success',function (file,response) {
                        $('#pr-avatar-upload').find('img').remove();
                        var avatar_url = '<img src="'+response.url+'" class="img-thumbnail user-avatar">';
                        $('#pr-avatar-upload').append(avatar_url);
                    });
                }
            });
            $('.birthday').datepicker({
                changeMonth: true,
                changeYear: true,
            });
            $('.change-pw-btn').on('click',function () {
                var password = $('.new-password').val();
                if(regularExpression.test(password)){
                    $('#chage-pw-form').submit();
                }
                else
                    $('#password-message').html('Must contain minimum of 8 characters, at least 1 capital, at least 1 number, at least 1 symbol');
            })
        });

    </script>
@endsection
