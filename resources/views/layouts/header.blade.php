<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{--<h3 class="header-title">{{ config('app.name', 'Klook Travel-Activities') }}</h3>--}}
            <img src="{{asset('assets/icons/IMG-20200912-WA0001.png')}}" style="height: 50px;" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown ">
                    <span class="navbar-toggler-icon"></span>
                    <a href="javascript:void(0);" class="navbar-toggle-button"  data-toggle="dropdown" aria-expanded="true" id="dropdown-category">Categories</a>
                    <div id="dropdown-category-list" class=" dropdown-favor-list dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-category">
                        <div class="ca-list">
                            <img src="{{asset('assets/icons/attractions_shows-5_jyobkk.png')}}" alt="">
                            <div class="ca-detail">
                                <h6 style="font-size: 16px;color: var(--dark-grey-color);font-weight: 600;">Things to do &nbsp;&nbsp;&nbsp; <span class="fa fa-caret-right"></span></h6>
                                <h6>Attractions</h6>
                                <h6>Activities</h6>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item nav-item-inline">
                    <span class="fa fa-mobile-phone"></span>
                    <a href="#" class="nav-link" >Download App</a>
                </li>
                <li class="nav-item nav-item-inline">
                    <span class="fa fa-question-circle-o "></span>
                    <a href="#" class="nav-link" >Help</a>
                </li>
                <li class="nav-item nav-item-inline">
                    <span class="fa fa-clock-o"></span>
                    <a href="#" class="nav-link" >Recently Viewed</a>
                </li>
                <li class="nav-item nav-item-inline">
                    <span class="fa fa-shopping-cart"></span>
                    <a href="#" class="nav-link" >Cart</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link login-button" href="{{ route('login') }}">{{ __('Log In') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                            <img src="{{ Auth::user()->avatar? Auth::user()->avatar:asset('assets/images/avatar.png')}}" alt="" style="width: 40px;height: 40px;border-radius: 50%" class="img-thumbnail">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(auth()->user()->user_role == 1)
                                <a href="{{route('admin',['active'=>'users'])}}" class="dropdown-item">Admin Page</a>
                                <a href="{{route('admin.add.product')}}" class="dropdown-item">Add New Product</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <a href="{{route('user.setting')}}" class="dropdown-item">Profile</a>
                                <a href="{{route('user.setting')}}" class="dropdown-item">Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endif

                        </div>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
