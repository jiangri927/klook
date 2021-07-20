<div class="col-md-9">
    <div class="pr-main">
        <h4 class="f-bold left-br">Change Password</h4>
        <h5 class="cl-black">Change your password regularly to improve your account security</h5>
        <form action="{{route('user.chanage.password')}}" method="post" id="chage-pw-form">
            @csrf
            <h5>Current Password</h5>
            <input type="password" class="form-control half-input  @error('old_password') is-invalid @enderror"  name="old_password" placeholder="Please Enter Current Password">
            @error('old_password')
            <p class="error-message" role="alert">
                {{$message}}
            </p>
            @enderror
            @if(\Illuminate\Support\Facades\Session::get('error_msg'))
                <p class="error-message" role="alert">
                   Incorrect Password
                </p>
            @endif
            <br>
            <h5>New Password(Passwords must be 8-20 characters long and must contain numbers, letters, and special symbols)</h5>
            <input type="password" class="form-control half-input  @error('password') is-invalid @enderror new-password"  name="password" placeholder="Please Enter New Password" value="{{old('password')}}">
            @error('password')
            <p class="error-message" role="alert">
                {{$message}}
            </p>
            @enderror
            <p class="error-message" id="password-message"></p>
            <br>
            <input type="password" class="form-control half-input  @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" placeholder="Please Confirm">
            @error('password_confirmation')
            <p class="error-message" role="alert">
                {{$message}}
            </p>
            @enderror
            <br>
            <a href="javascript:void(0);" class="btn btn-save change-pw-btn">Save</a>
            @if(\Illuminate\Support\Facades\Session::get('success_msg'))
                <p class="success" role="alert">
                    You have changed your psasword successfully.
                </p>
            @endif
        </form>
    </div>
    <br>
    <div class="pr-main">
        <h4 class="f-bold left-br">Notification Preferences</h4>
        <h5 class="cl-black">You are managing the notification preferences for {{$user->email}}</h5>
        <br>
        <form action="" method="post">
            @csrf
            <h5>Updates and Promotions</h5>
            <h5>Be first to know about our latest campaigns, promo codes, discounts and new features</h5>
            <div class="icheck-material-teal icheck-inline">
                <input type="radio" id="chb1" name="represent_company" value="on" checked/>
                <label for="chb1">Yes</label>
            </div>
            <div class="icheck-material-teal icheck-inline">
                <input type="radio" id="chb2" name="represent_company" value="off"  />
                <label for="chb2">No</label>
            </div>
            <br>
            <button type="submit" class="btn btn-save">Update Preferences</button>
        </form>
    </div>
    <div class="pr-main">
        <h4 class="f-bold left-br">Delete Account</h4>
        <h5 class="cl-black">Delete your Klook account and personal data</h5>
    </div>
</div>
