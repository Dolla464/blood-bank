@extends('website.layouts.app')

@section('content')
<div class="contact-us">
    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                    </ol>
                </nav>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>اتصل بنا</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{ asset('website/assets/imgs/logo.png') }}">
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>الجوال:</span> {{ $settings->phone ?? '-' }}</li>
                                    <li><span>فاكس:</span> 234234234</li>
                                    <li><span>البريد الإلكترونى:</span> {{ $settings->email ?? '-' }}</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="{{ $settings->fb_url }}" target="_blank"><img src="{{ asset('website/assets/imgs/001-facebook.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{ $settings->x_url }}" target="_blank"><img src="{{ asset('website/assets/imgs/002-twitter.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{ $settings->youtube_url }}" target="_blank"><img src="{{ asset('website/assets/imgs/003-youtube.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{ $settings->insta_url }}" target="_blank"><img src="{{ asset('website/assets/imgs/004-instagram.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="https://wa.me/{{ $settings->phone }}" target="_blank"><img src="{{ asset('website/assets/imgs/005-whatsapp.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#" target="_blank"><img src="{{ asset('website/assets/imgs/006-google-plus.svg') }}"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>تواصل معنا</h4>
                        </div>
                        <div class="fields">
                            <form method="POST" action="{{ route('website.contact_submit') }}" novalidate>
                                @csrf
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" placeholder="الإسم" name="name"
                                value="{{ Auth::guard('client-web')->user()->name ?? '' }}">
                                @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="البريد الإلكترونى" name="email"
                                value="{{ Auth::guard('client-web')->user()->email ?? '' }}">
                                @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="الجوال" name="phone"
                                value="{{ Auth::guard('client-web')->user()->phone ?? '' }}">
                                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="عنوان الرسالة" name="title" value="{{ old('title') }}">
                                @error('title') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                                <textarea placeholder="نص الرسالة" class="form-control @error('text') is-invalid @enderror" id="content" rows="3" name="text">{{ old('text') }}</textarea>
                                <button type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection