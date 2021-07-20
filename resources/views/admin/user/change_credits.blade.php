@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection
@section('content')

    <div class="container">
        <div class="row " style="padding: 40px;">
            <div class="col-md-12" style="padding: 0;">
                <h4 style="background: rgb(146 206 243);padding: 10px 20px;color: white;">Notice : <a href="{{route('admin',['active'=>'credits'])}}">Click Here</a> to search for other user</h4>
                <div class="row" style="background: rgb(146 206 243);padding:20px;color: white; margin: 0;" >
                    <div class="col-md-8">
                        <h2>
                            {{$user->username}}
                        </h2>
                    </div>
                    <div class="col-md-4" >
                        <h5>Available Credits</h5>
                        <h1>{{$user->credits}}</h1>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-4" style="padding: 0;background: #dad9d9;">
                <ul class="nav nav-tabs e-s-side" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="add-tab" href="#add" aria-controls="add"
                           data-toggle="tab" role="tab" aria-selected="true"><span class="fa fa-plus"></span>Add Credits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="substract-tab" href="#substract" aria-controls="substract"
                           data-toggle="tab" role="tab" aria-selected="true"><span class="fa fa-minus"></span>Substract Credits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="transfer-tab" href="#transfer" aria-controls="transfer"
                           data-toggle="tab" role="tab" aria-selected="true"><span class="fa fa-lock"></span>Transfer</a>
                    </li>

                </ul>
            </div>
            <div class="col-md-8" style="background: white;padding: 25px;">
                <div class="tab-content">

                    <div class="tab-pane fade active show" id="add" role="tabpanel" aria-labelledby="add-tab">
                        <div class="change-section">
                            <form action="{{route('admin.user.add.credits',['user_id'=>$user->id])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>UserName</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}" disabled>
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Amount($)</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{old('amount')}}" required>
                                        @error('amount')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Reason</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea name="reason" id=""  rows="3" class="form-control" required></textarea>
                                        @error('amount')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-save">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade  show" id="substract" role="tabpanel" aria-labelledby="add-tab">
                        <div class="change-section">
                            <form action="{{route('admin.user.substract.credits',['user_id'=>$user->id])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>UserName</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}" disabled>
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Amount($)</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{old('amount')}}" required>
                                        @error('amount')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Reason</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea name="reason" id=""  rows="3" class="form-control" required></textarea>
                                        @error('amount')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-save">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade  show" id="transfer" role="tabpanel" aria-labelledby="add-tab">
                        <div class="change-section">
                            <form action="{{route('admin.user.transfer.credits',['user_id'=>$user->id])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>From UserName</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}" disabled>
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>To UserName</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="to_username" class="form-control @error('to_username') is-invalid @enderror" value="" id="transfer-username" required>
                                        <div class="users-info"></div>
                                        <br>
                                    </div>
                                    <div class="col-md-4" style="display: flex;">
                                        <h5>Amount($)</h5><span style="color: red;">*</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{old('amount')}}" required>
                                        @error('amount')
                                        <p class="error-message" role="alert">{{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-save">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </div>
        <div class="row" style="padding: 40px;text-align: center">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <table class="table  table-striped" style="width: 100%;">
                        <tr>
                            <th>No</th>
                            <th>Date & Time</th>
                            <th>Order No</th>
                            <th>Detail</th>
                            <th>Amount</th>
                        </tr>
                        @foreach($history as $index=>$item)
                            <tr>
                                <td>{{$index}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->order_id}}</td>
                                <td>{{$item->detail}}</td>
                                <td>{{$item->amount}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additional_js')
    <script>
        var dates = new Array();
        var data = '{{$usernames}}';
        for (var i = 0 ;i<data.split(',').length;i++) {
            dates.push(data.split(',')[i]);
        }
        $(function () {

            $.ajax({
                url:'{{route('get.username')}}',
                method:'get',
                success:function (response) {
                    data = response.users;
                }
            });
            console.log(data);
            $('#transfer-username').autocomplete({
                source:dates,
            });
        })
    </script>
@endsection
