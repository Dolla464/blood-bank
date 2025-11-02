<!--app-->
<div class="app">
    <div class="container">
        <div class="row">
            <div class="info col-md-6">
                <h3>تطبيق بنك الدم</h3>
                <p>
                    {{ \Illuminate\Support\Str::words($settings->about_app, 20) }}
                </p>
                <div class="download">
                    <h4>متوفر على</h4>
                    <div class="row stores">
                        <div class="col-sm-6">
                            <a href="#">
                                <img src="{{ asset('website/assets/imgs/google.png') }}">
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#">
                                <img src="{{ asset('website/assets/imgs/ios.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screens col-md-6">
                <img src="{{ asset('website/assets/imgs/App.png') }}">
            </div>
        </div>
    </div>
</div>