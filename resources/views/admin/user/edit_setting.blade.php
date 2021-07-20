@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection
@section('content')

    <div class="container">
        <div class="row " style="padding: 40px;">
            <div class="col-md-12" style="padding: 0;">
                <h4 style="background: rgb(146 206 243);padding: 10px 20px;color: white;">Notice : <a href="{{route('admin',['active'=>'management'])}}">Click Here</a> for updating account details for others</h4>
                <br>
            </div>
            <div class="col-md-4" style="padding: 0;background: #dad9d9;">
                <ul class="nav nav-tabs e-s-side" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="username-tab" href="#username" aria-controls="username"
                           data-toggle="tab" role="tab" aria-selected="true"><span class="fa fa-user"></span>Change UserName</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="email-tab" href="#email" aria-controls="email"
                           data-toggle="tab" role="tab" aria-selected="true"><span class="fa fa-envelope"></span>Change Email</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" href="#password" aria-controls="password"
                           data-toggle="tab" role="tab" aria-selected="true"><span class="fa fa-lock"></span>Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="status-tab" href="#status" aria-controls="status"
                           data-toggle="tab" role="tab" aria-selected="true"><span class="fa fa-key"></span>Change User Status</a>
                    </li>

                </ul>
            </div>
            <div class="col-md-8" style="background: white;padding: 25px;">
                <div class="tab-content">

                    <div class="tab-pane fade active show" id="username" role="tabpanel" aria-labelledby="username-tab">
                        <div class="change-header"><h3 class="left-br">Change UserName-</h3><h3 class="change-title">{{$user->username}}</h3></div>
                        <br>
                        <div class="change-section">
                            <form action="{{route('admin.change.username',['user_id'=>$user->id])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>New User Name</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')?old('username'):$user->username}}" required>
                                        @error('username')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Re-Enter User Name</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="confirm_username" class="form-control @error('confirm_username') is-invalid @enderror" value="{{old('confirm_username')}}" required>
                                        @error('confirm_username')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-save">Change UserName</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade  show" id="email" role="tabpanel" aria-labelledby="email-tab">
                        <div class="change-header" ><h3 class="left-br">Change Email-</h3><h3 class="change-title">{{$user->email}}</h3></div>
                        <br>
                        <div class="change-section">
                            <form action="{{route('admin.change.email',['user_id'=>$user->id])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>New Email</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')?old('email'):$user->email}}" required>
                                        @error('email')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Re-Enter Email </h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="email" name="confirm_email" class="form-control @error('confirm_email') is-invalid @enderror" value="{{old('confirm_email')}}" required>
                                        @error('confirm_email')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-save">Change Email</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade  show" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <div class="change-header" ><h3 class="left-br">Change Password-</h3><h3 class="change-title">{{$user->username}}</h3></div>
                        <br>
                        <div class="change-section">
                            <form action="{{route('admin.change.password',['user_id'=>$user->id])}}" method="post" id="change-password-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>New Password</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="new-password" value="" required>
                                        @error('password')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <p class="error-message" id="password-message"></p>
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Re-Enter Password</h5><span style="color: red;">*</span>

                                    </div>
                                    <div class="col-md-8">
                                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm-password" value="">
                                        @error('confirm_password')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a href="javascript:void(0);" class="btn btn-save" id="change-password-button">Change Password</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade  show" id="status" role="tabpanel" aria-labelledby="status-tab">
                        <div class="change-header" ><h3 class="left-br">Change User Status-</h3><h3 class="change-title">{{$user->username}}</h3></div>
                        <br>
                        <div class="change-section" style="text-align: center;">
                            <form action="{{route('admin.change.status',['user_id'=>$user->id])}}" method="post">
                                @csrf
                                <div class="icheck-material-teal icheck-inline">
                                    <input type="radio" id="chb1" name="status" value="Active"  {{$user->status == 'Active'?'checked':''}} />
                                    <label for="chb1">Active</label>
                                </div>
                                <div class="icheck-material-teal icheck-inline">
                                    <input type="radio" id="chb2" name="status" value="Inactive" {{$user->status == 'Inactive'?'checked':''}} />
                                    <label for="chb2">Inactive</label>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-save">Change User Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additional_js')
    <script>
        $(function () {
            var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
            $('#change-password-button').on('click',function () {
                var password = $('#new-password').val();
                if(regularExpression.test(password)){
                    if (password === $('#confirm-password').val())
                        $('#change-password-form').submit();
                    else
                        $('#password-message').html('Not matched');
                }
                else
                    $('#password-message').html('Must contain minimum of 8 characters, at least 1 lower, at least 1 capital, at least 1 number, at least 1 symbol');
            })
        })
    </script>
@endsection
