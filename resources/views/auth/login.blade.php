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
                        <h3 class="card-title text-left mb-3">Login</h3>
                        <form method="post" action="{{route('login')}}">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control p_input" name="email" value="{{old('email')}}">
                                @if(!empty($error_msg))
                                    <p class="error-message" role="alert">
                                        {{$error_msg}}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control p_input" name="password">
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input">
                                        Yes! I would like to receive special offers, promotion and other information from Klook. I understand I can unsubscribe at any time.
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">Log In</button>
                                <br>
                                <h6>Don't have an Account?<a href="{{route('register')}}">Sign Up</a></h6>
                                <hr>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-facebook col mr-2" href="{{route('auth.provider',['provider'=>'facebook'])}}">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-google col" href="{{route('auth.provider',['provider'=>'google'])}}">
                                    <i class="fa fa-google"></i> Google plus
                                </a>
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
