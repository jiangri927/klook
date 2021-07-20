<div class="col-md-9">
    <div class="pr-main">
        <h3 class="f-bold left-br">Account Information</h3>
        <h5 class="cl-black">This information is used to autofill your details to make it quicker for you to book. Your details will be stored securely and won't be shared publicly.</h5>
        <form action="{{route('user.profile.save')}}" method="post">
            @csrf
            <div class="form-group row">
                <div class="col-md-3">
                    <h5>Title</h5>
                    <select name="title" id="" class="form-control" >
                        <option value="0">Please Select</option>
                        <option value="Mr" {{$user->title=='Mr'?'selected':''}}>Mr</option>
                        <option value="MRS" {{$user->title=='MRS'?'selected':''}}>MRS</option>
                        <option value="MISS" {{$user->title=='MISS'?'selected':''}}>MISS</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <h5>First Name</h5>
                    <input type="text" name="first_name" placeholder="Please Enter" class="form-control" value="{{$user->first_name}}">
                </div>
                <div class="col-md-4">
                    <h5>Last Name</h5>
                    <input type="text" name="second_name" placeholder="Please Enter" class="form-control" value="{{$user->second_name}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <h5>Country/Region of Travel Document</h5>
                    <select name="country" id="" class="form-control">
                        <option value="0">Please Select</option>
                        @foreach($country as $item)
                            <option value="{{$item->name}}" {{$user->country==$item->name?'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <h5>Post Code</h5>
                    <input type="text" name="postcode" class="form-control" placeholder="Please Enter" value="{{$user->postcode}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <h5>State</h5>
                    <input type="text" name="state" class="form-control" placeholder="Please Enter" value="{{$user->state}}">
                </div>
                <div class="col-md-4">
                    <h5>City</h5>
                    <input type="text" name="city" class="form-control" placeholder="Please Enter" value="{{$user->city}}">
                </div>
                <div class="col-md-4">
                    <h5>Address</h5>
                    <input type="text" name="address" class="form-control" placeholder="Please Enter" value="{{$user->address}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <h5>Phone Code</h5>
                    <select name="countrycode" id="" class="form-control">
                        <option value="0">Please Select</option>
                        @foreach($country as $item)
                            <option value="{{$item->phonecode}}" {{$user->countryCode == $item->phonecode?'selected':''}}>{{$item->name.' +('.$item->phonecode.')'}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <h5>Phone number (In case of emergency)</h5>
                    <input type="text" name="number" placeholder="Please Enter" class="form-control" value="{{$user->number}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-5">
                    <h5>Birthday</h5>
                    <input type="text" name="birthday" placeholder="Please Enter" class="form-control birthday" value="{{$user->birthday}}">
                </div>
                <div class="col-md-5">
                    <h5>AIVA UserName</h5>
                    <input type="text" name="aiva" placeholder="Please Enter" class="form-control" value="{{$user->aiva}}" disabled>
                </div>
            </div>
            <div class="form-group row">

                <div class="col-md-6">
                    <h5>Email (To Receive Voucher)</h5>
                    <input type="email" name="email" placeholder="Please Enter" class="form-control" value="{{$user->email}}">
                </div>
            </div>
            <button type="submit" class="btn  btn-save">Save</button>
        </form>
    </div>

</div>
