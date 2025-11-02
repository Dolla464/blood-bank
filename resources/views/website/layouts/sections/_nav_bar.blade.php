<!--nav-->
<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('website.home') }}">
                <img src="{{ asset('website/assets/imgs/logo.png') }}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('website.home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.home') }}">الرئيسية <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('website.about_app') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.about-app') }}">عن بنك الدم</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('website.articles') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.articles') }}">المقالات</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('website.donation-requests') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.donation-requests') }}">طلبات التبرع</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('website.who-are-us') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.who-are-us') }}">من نحن</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('website.contact-us') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.contact-us') }}">اتصل بنا</a>
                    </li>
                </ul>

                @guest('client-web')
                    <!-- Guest User Section -->
                    <div class="accounts">
                        <a href="{{ route('website.register') }}" class="create">إنشاء حساب جديد</a>
                        <a href="{{ route('website.login') }}" class="signin">الدخول</a>
                    </div>
                @endguest

                @auth('client-web')
                    <!-- Authenticated User Section -->
                    <div class="user-section">
                        <!-- Donation Request Button -->
                        <a href="{{ route('website.create-donation') }}" class="donate">
                            <img src="{{ asset('website/assets/imgs/transfusion.svg') }}">
                            <p>طلب تبرع</p>
                        </a>
                    </div>
                @endauth




            </div>
        </div>
    </nav>
</div>
