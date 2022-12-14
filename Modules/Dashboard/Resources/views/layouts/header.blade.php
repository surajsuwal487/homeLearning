<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <h5 class="text-capitalize">{{ auth()->user()->name }}</h5>
                </div>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">
                                </span><span class="user-status"></span>
                            </div>
                            <i class="fa fa-bell"></i>
                            @if(auth()->user()->unreadnotifications->count())
                            <span class="badge badge-danger">{{ auth()->user()->unreadnotifications->count() }}</span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a style="color: green" href="{{ route('markRead') }}">Mark all as Read</a>
                            <br>
                            @foreach (auth()->user()->unreadNotifications as $notification)
                            <a style="background-color: lightgray" class="dropdown-item" href="page-user-profile.html"><i class="feather"></i>
                                {{ $notification->data['data'] }}</a>                              
                            @endforeach

                            @foreach (auth()->user()->readNotifications as $notification)
                            <a class="dropdown-item" href="page-user-profile.html"><i class="feather"></i>
                                {{ $notification->data['data'] }}</a>                              
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                class="ficon feather icon-maximize"></i></a></li>

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">
                                </span><span class="user-status"></span>
                            </div>
                            @if (auth()->user()->image == null)
                                <span><img class="round" src="{{ url('admin/images/default/default_user.png') }}"
                                        alt="avatar" height="40" width="40"></span>
                            @else
                                <span><img class="round"
                                        src="{{ url('uploads/images/users/' . auth()->user()->image) }}" alt="avatar"
                                        height="40" width="40"></span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="page-user-profile.html"><i class="feather icon-user"></i>
                                Edit Profile</a>
                            {{-- <form action="{{ route('cd-admin.edituser') }}"
                                                    method="get">
                                                    <input type="hidden" name="user" value="{{ auth()->user()->slug}}">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="feather icon-user"></i> Edit User
                                                       </button>
                                                    </form> --}}

                            <form method="get" action="{{ route('logout') }}">
                                @csrf
                                <!-- Authentication -->
                                <a class="dropdown-item" href="route('logout')"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    <i class="feather icon-power"></i> {{ __('Log Out') }}</a>
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
{{-- @can('admin') --}}
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Suraj Home</h2>
                </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{ route('cd-admin.dashboard') }}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="Email">Dashboard</span></a>
            </li>
            @include('dashboard::layouts.sidebar')
        </ul>
    </div>
</div>
{{-- @endcan --}}


{{-- @can('superadmin') --}}
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Suraj Home</h2>
                </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{ route('cd-admin.dashboard') }}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="Email">Dashboard</span></a>
            </li>
            @include('dashboard::layouts.sidebar')
        </ul>
    </div>
</div>
{{-- @endcan --}}


<!-- END: Main Menu-->
