@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section('content')
    <div class="container-scroller login-bg">
        <div class="container-fluid page-body-wrapper">
            <div class="row">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Sign Up</h3>
                        <form method="post" action="{{route('register')}}" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}" required>
                                @error('username')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control p_input @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required>
                                @error('email')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control new-password @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                                <p class="error-message" id="password-message"></p>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="check_terms" required>
                                        Yes! I would like to receive special offers, promotion and other information from Klook. I understand I can unsubscribe at any time.
                                    </label>
                                    @error('check_terms')
                                    <p class="error-message" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="javascript:void(0);" class="btn btn-primary btn-block enter-btn register-btn">Register</a>
                                <br>
                                <h6>Already have an Account?<a href="{{route('login')}}">Login</a></h6>
                                <hr>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-facebook col mr-2">
                                    <i class="fa fa-facebook"></i> Facebook
                                </button>
                                <button class="btn btn-google col">
                                    <i class="fa fa-google"></i> Google plus
                                </button>
                            </div>
                            <br>
                            <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
                        </form>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
@section('additional_js')
    <script>
        var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
        $(function () {
            $('.register-btn').on('click',function () {
                var password = $('.new-password').val();
                if(regularExpression.test(password)){
                        $('#register-form').submit();
                }
                else
                    $('#password-message').html('Must contain minimum of 8 characters, at least 1 capital, at least 1 number, at least 1 symbol');
            })
        });

    </script>
@endsection
