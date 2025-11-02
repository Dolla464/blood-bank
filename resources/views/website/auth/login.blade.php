@extends('website.layouts.app')

@section('content')
    <!--form-->
    <div class="signin-account">
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                        </ol>
                    </nav>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}
                    </div>
                @endif

                <div class="signin-form">
                    <form method="POST" action=" {{ route('website.login') }}">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('website/assets/imgs/logo.png') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="login" class="form-control @error('login') is-invalid @enderror"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الجوال أو البريد الإلكتروني"
                                value="{{ old('login') }}">
                            @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
                                placeholder="كلمة المرور">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row options">
                            <div class="col-md-6 remember">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot">
                                <img src="{{ asset('website/assets/imgs/complain.png') }}">
                                <a href="{{ route('website.password.request') }}">هل نسيت كلمة المرور</a>
                            </div>
                        </div>
                        <div class="row buttons">
                            <div class="col-md-6 right">
                                <button type="submit" class="btn btn-success w-100 m-2">دخول</button>
                            </div>
                            <div class="col-md-6 left">
                                <a href="{{ route('website.register') }}">انشاء حساب جديد</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
