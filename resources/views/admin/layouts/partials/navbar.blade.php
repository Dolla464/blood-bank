<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('admin') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->



        <!-- Notifications Dropdown Menu -->

        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>


        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown user-menu">
                <a class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" href="#">
                    <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('adminlte/img/user2-160x160.jpg') }}"
                        alt="User Image" class="user-image img-circle elevation-2" width="30" height="30">
                    <span class="d-none d-md-inline ml-2">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-dark">
            <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('adminlte/img/user2-160x160.jpg') }}"
                 class="img-circle elevation-2"
                 alt="User Image">
            <p>
                {{ Auth::user()->name }}
                <small>{{ Auth::user()->email }}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="{{ route('admin.profile', auth()->user()->id)  }}" class="btn btn-info btn-flat">Profile</a>
            <a href="#"
               class="btn btn-danger btn-flat float-right"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
                {{-- <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.profile', auth()->user()->id) }}" class="dropdown-item">
                        <i class="fas fa-id-badge mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li> --}}

        @endguest
    </ul>
</nav>
<!-- /.navbar -->
