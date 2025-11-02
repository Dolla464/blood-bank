<!--upper-bar-->
<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="language">
                    <a href="index.html" class="ar active">عربى</a>
                    <a href="index-ltr.html" class="en inactive">EN</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="social">
                    <div class="icons">
                        <a href="{{ $settings->fb_url }}" target="_blank" class="facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->insta_url }}" target="_blank" class="instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->x_url }}" target="_blank" class="twitter"><i
                                class="fab fa-twitter"></i></a>
                        <a href="{{ $settings->youtube_url }}" class="youtube"><i class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/{{ $settings->phone }}" target="_blank" class="whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- not a member-->
            <div class="col-lg-6">
                @guest('client-web')
                    <div class="info"">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>{{ $settings->phone }}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{ $settings->email }}</p>
                        </div>
                        <div>
                            <a class="btn btn-danger" href="{{ route('admin.login') }}">admins login</a>
                        </div>
                    </div>
                @endguest

                {{-- <!--I'm a member --}}

                @auth('client-web')
                    <div class="member">
                        <p class="welcome">مرحباً بك</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::guard('client-web')->user()->name }}
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('website.home') }}">
                                    <i class="fas fa-home"></i>
                                    الرئيسية
                                </a>
                                <a class="dropdown-item" href="{{ route('website.profile.edit') }}">
                                    <i class="far fa-user"></i>
                                    معلوماتى
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-bell"></i>
                                    اعدادات الاشعارات
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-heart"></i>
                                    المفضلة
                                </a>
                                <a class="dropdown-item" href="{{ route('website.profile.donations') }}">
                                    <i class="far fa-comments"></i>
                                    طلبات التبرع الخاصة بي
                                </a>
                                <a class="dropdown-item" href="{{ route('website.contact-us') }}">
                                    <i class="fas fa-phone-alt"></i>
                                    تواصل معنا
                                </a>
                                <form method="POST" action="{{ route('website.logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <i class="fas fa-sign-out-alt" style="margin-left: 8px;"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth


            </div>
        </div>
    </div>
</div>
