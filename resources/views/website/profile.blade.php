@extends('website.layouts.app')

@section('content')
    <div class="create">
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">بياناتي الشخصية</li>
                        </ol>
                    </nav>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="account-form">
                    <form action="{{ route('website.profile.update') }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- الاسم --}}
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', auth('client-web')->user()->name) }}" placeholder="الاسم">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- البريد الإلكتروني --}}
                        <input type="email" class="form-control mt-3 @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email', auth('client-web')->user()->email) }}" placeholder="البريد الإلكتروني">
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- تاريخ الميلاد --}}
                        <input type="date" class="form-control mt-3 @error('date_of_birth') is-invalid @enderror"
                            name="date_of_birth" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}"
                            placeholder="تاريخ الميلاد">
                        @error('date_of_birth')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- فصيلة الدم --}}
                        <select class="form-control mt-3 @error('blood_type_id') is-invalid @enderror" name="blood_type_id">
                            <option disabled hidden>اختر فصيلة الدم</option>
                            @foreach ($bloodTypes as $bloodType)
                                <option value="{{ $bloodType->id }}"
                                    {{ old('blood_type_id', auth('client-web')->user()->blood_type_id) == $bloodType->id ? 'selected' : '' }}>
                                    {{ $bloodType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('blood_type_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- المحافظة --}}
                        <select class="form-control mt-3 @error('governorate_id') is-invalid @enderror"
                            name="governorate_id" id="governorates"
                            data-old-gov="{{ old('governorate_id', auth()->user()->city->governorate_id ?? '') }}">
                            <option disabled hidden>اختر المحافظة</option>
                            @foreach ($governorates as $gov)
                                <option value="{{ $gov->id }}"
                                    {{ old('governorate_id', auth('client-web')->user()->city->governorate_id ?? '') == $gov->id ? 'selected' : '' }}>
                                    {{ $gov->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- المدينة --}}
                        <select class="form-control mt-3 @error('city_id') is-invalid @enderror" name="city_id"
                            id="cities">
                            @if (auth('client-web')->user()->city)
                                <option value="{{ auth('client-web')->user()->city->id }}" selected>
                                    {{ auth('client-web')->user()->city->name }}
                                </option>
                            @else
                                <option disabled hidden>اختر المدينة</option>
                            @endif
                        </select>
                        @error('city_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- رقم الهاتف --}}
                        <input type="text" class="form-control mt-3 @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone', auth('client-web')->user()->phone) }}" placeholder="رقم الهاتف">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- آخر تاريخ تبرع --}}
                        <input type="date" class="form-control mt-3 @error('last_donation_date') is-invalid @enderror"
                            name="last_donation_date"
                            value="{{ old('last_donation_date', auth('client-web')->user()->last_donation_date) }}"
                            placeholder="آخر تاريخ تبرع">
                        @error('last_donation_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- كلمة المرور الجديدة --}}
                        <input type="password" class="form-control mt-3 @error('password') is-invalid @enderror"
                            name="password" placeholder="كلمة المرور الجديدة (اختياري)">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- تأكيد كلمة المرور --}}
                        <input type="password"
                            class="form-control mt-3 @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" placeholder="تأكيد كلمة المرور الجديدة (اختياري)">
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <div class="create-btn mt-4">
                            <input type="submit" value="تحديث البيانات">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
