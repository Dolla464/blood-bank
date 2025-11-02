<!--footer-->
<div class="footer">
    <div class="inside-footer">
        <div class="container">
            <div class="row">
                <div class="details col-md-4">
                    <img src="{{ asset('website/assets/imgs/logo.png') }}">
                    <h4>بنك الدم</h4>
                    <p>
                        {{ \Illuminate\Support\Str::words($settings->about_app, 20) }}
                    </p>
                </div>
                <div class="pages col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('website.home') ? 'active' : '' }}"
                            id="list-home-list" href="{{ route('website.home') }}" role="tab"
                            aria-controls="home">الرئيسية</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('website.about-app') ? 'active' : '' }}"
                            id="list-profile-list" href="{{ route('website.about-app') }}" role="tab"
                            aria-controls="profile">عن بنك الدم</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('website.articles') ? 'active' : '' }}"
                            id="list-messages-list" href="{{ route('website.articles') }}" role="tab"
                            aria-controls="messages">المقالات</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('website.donation-requests') ? 'active' : '' }}"
                            id="list-settings-list" href="{{ route('website.donation-requests') }}" role="tab"
                            aria-controls="settings">طلبات التبرع</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('website.who-are-us') ? 'active' : '' }}"
                            id="list-settings-list" href="{{ route('website.who-are-us') }}" role="tab"
                            aria-controls="settings">من نحن</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('website.contact-us') ? 'active' : '' }}"
                            id="list-settings-list" href="{{ route('website.contact-us') }}" role="tab"
                            aria-controls="settings">اتصل بنا</a>
                    </div>
                </div>
                <div class="stores col-md-4">
                    <div class="availabe">
                        <p>متوفر على</p>
                        <a href="#">
                            <img src="{{ asset('website/assets/imgs/google1.png') }}">
                        </a>
                        <a href="#">
                            <img src="{{ asset('website/assets/imgs/ios1.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="other">
        <div class="container">
            <div class="row">
                <div class="social col-md-4">
                    <div class="icons">
                        <a href="{{ $settings->fb_url }}" target="_blank" class="facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->insta_url }}" target="_blank" class="instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->x_url }}" target="_blank" class="twitter"><i
                                class="fab fa-twitter"></i></a>
                        <a href="{{ $settings->youtube_url }}" target="_blank" class="youtube"><i
                                class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/{{ $settings->phone }}" target="_blank" class="whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="rights col-md-8">
                    <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2025</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Bootstrap (bundle contains Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

<!-- Use a single Bootstrap bundle include after jQuery -->
<script src="{{ asset('website/assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('website/assets/js/owl.carousel.min.js') }}"></script>

<script defer src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="{{ asset('website/assets/js/main.js') }}"></script>

<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.favouritee-btn');
        if (!btn) return;

        const icon = btn.querySelector('i');

        // بدّل الكلاس بين fas (قلب مليان) و far (قلب فاضي)
        icon.classList.toggle('far');
        icon.classList.toggle('fas');
    });
</script>
</body>

</html>
