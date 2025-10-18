<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Custom Sidebar CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/custom-sidebar.css') }}">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte') }}/img/icon.png" alt="BloodBank Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">BloodBank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('adminlte/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.profile', auth()->user()->id) }}"" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                @can('read users')
                        <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('read roles')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}"
                        class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Roles
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('read clients')
                <li class="nav-item">
                    <a href="{{ route('clients.index') }}"
                        class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Clients
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('read governorates')
                <li class="nav-item">
                    <a href="{{ route('governorates.index') }}"
                        class="nav-link {{ request()->routeIs('governorates.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Governorates
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('read cities')
                <li class="nav-item">
                    <a href="{{ route('cities.index') }}"
                     class="nav-link {{ request()->routeIs('cities.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            Cities
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('read categories')
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                     class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Categories
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('read posts')
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}"
                     class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Posts
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('read donations')
                <li class="nav-item">
                    <a href="{{ route('donations.index') }}"
                     class="nav-link {{ request()->routeIs('donations.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tint"></i>
                        <p>
                            Donation Requests
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan
                
                @can('read messages')
                <li class="nav-item">
                    <a href="{{ route('messages.index') }}"
                     class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Clients Messages
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endcan
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('bloodtypes.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tint"></i>
                        <p>
                            Blood Types
                        </p>
                    </a>
                </li> --}}
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
