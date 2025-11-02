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
                            <li class="breadcrumb-item active" aria-current="page">إدخال كود التحقق</li>
                        </ol>
                    </nav>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}
                    </div>
                @endif

                <div class="signin-form">
                    <form method="POST" action="{{ route('website.password.update') }}">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('website/assets/imgs/logo.png') }}">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكتروني"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="verification_code"
                                class="form-control @error('verification_code') is-invalid @enderror"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="كود التحقق"
                                value="">
                            @error('verification_code')
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

                        <div class="form-group">
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleInputPassword1"
                                placeholder="تأكيد كلمة المرور">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row buttons">
                            <div class="col-md-6 right">
                                <button type="submit" class="btn btn-success w-100 m-2">تغيير كلمة المرور</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
