

<div class="col-md-3 col-lg-3 col-xl-3">
    <div class="pr-side">
        <div class="side-user text-center">
            <form action="{{route('upload.avatar')}}" class="dropzone" id="pr-avatar-upload" method="post">
                @csrf
                    <div class="dz-message pr-avatar-thumb">
                        <img src="{{$user->avatar?$user->avatar:asset('assets/images/avatar.png')}}" alt="" class="img-thumbnail user-avatar" >
                    </div>
            </form>
{{--            <img src="{{asset('assets/images/avatar.png')}}" alt="" class="img-thumbnail user-avatar" >--}}
            <i class="fa fa-camera up-camera"></i>
            <h2>{{$user->name}}</h2>
            <a href="{{route('user.account.edit')}}" style="color:{{$side=='Edit Profile'?' var(--red-color)':''}}">Edit Profile</a>
        </div>
        <div class="side-list">
            <h5><span class="fa fa-code"></span> &nbsp;&nbsp;Promo codes </h5>
            <h5><span class="fa fa-money"></span> &nbsp;&nbsp;<a href="{{route('user.credits')}}" style="color:{{$side=='Credits'?' var(--red-color)':'var(--dark-color)'}}">
                    Rewards
                </a></h5>
            <h5><span class="fa fa-gift"></span> &nbsp;&nbsp;Travelook Credits</h5>
        </div>
        <div class="side-list">
            <h5><span class="fa fa-book"></span> &nbsp;&nbsp;Bookings </h5>
            <h5><span class="fa fa-history"></span> &nbsp;&nbsp;<a href="{{route('user.reviews')}}" style="color:{{$side=='Reviews'?' var(--red-color)':'var(--dark-color)'}}">
                    Reviews
                </a></h5>
            <h5><span class="fa fa-paypal"></span> &nbsp;&nbsp;Manage Payment Methods</h5>
            <h5><span class="fa fa-users"></span> &nbsp;&nbsp;Manage passengers</h5>
            <h5><span class="fa fa-heart-o"></span> &nbsp;&nbsp;<a href="{{route('user.wishlist')}}" style="color:{{$side=='Wishlist'?' var(--red-color)':'var(--dark-color)'}}">
                    Wishlist
                </a></h5>
            <h5><span class="fa fa-simplybuilt"></span> &nbsp;&nbsp;My YSIM</h5>
        </div>
        <div class="side-list">
            <h5><span class="fa fa-sign-in"></span> &nbsp;&nbsp;Manage Login Methods</h5>
            <h5><span class="fa fa-user-secret"></span> &nbsp;&nbsp;<a href="{{route('user.setting')}}" style="color:{{$side=='Settings'?' var(--red-color)':'var(--dark-color)'}}">
                    Settings
                </a></h5>
        </div>
    </div>
</div>
