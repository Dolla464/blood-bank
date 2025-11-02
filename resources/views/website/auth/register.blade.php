@extends('website.layouts.app')

@section('content')
    <!--form-->
    <div class="create">
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">إنشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>

                @if (session('info'))
                    <div class="alert alert-warning">{{ session('info') }}</div>
                @endif

                <div class="account-form">
                    <form action="{{ route('website.register') }}" method="POST" novalidate>
                        @csrf

                        {{-- الاسم --}}
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="الاسم" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- البريد (اختياري) --}}
                        <input type="email" class="form-control mt-3 @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- تاريخ الميلاد --}}
                        <input class="form-control mt-3 @error('date_of_birth') is-invalid @enderror" name="birthday_date"
                            id="birthday_date" type="date" value="{{ old('date_of_birth') }}"
                            placeholder="تاريخ الميلاد">
                        @error('date_of_birth')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- فصيلة الدم --}}
                        <select class="form-control mt-3 @error('blood_type_id') is-invalid @enderror" name="blood_type_id"
                            id="bloodTypes">
                            <option selected disabled hidden value="">فصيلة الدم</option>
                            @foreach ($bloodTypes as $bloodType)
                                <option value="{{ $bloodType->id }}"
                                    {{ old('blood_type_id') == $bloodType->id ? 'selected' : '' }}>
                                    {{ $bloodType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('blood_type_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- المحافظة --}}
                        <select class="form-control mt-3 @error('governorate_id') is-invalid @enderror"
                            name="governorate_id" id="governorates" data-old-gov="{{ old('governorate_id') }}"
                            data-old-city="{{ old('city_id') }}">
                            <option selected disabled hidden value="">اختر المحافظة</option>
                            @foreach ($governorates as $gov)
                                <option value="{{ $gov->id }}"
                                    {{ old('governorate_id') == $gov->id ? 'selected' : '' }}>
                                    {{ $gov->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- المدينة --}}
                        <select class="form-control mt-3 @error('city_id') is-invalid @enderror" name="city_id"
                            id="cities" {{ old('governorate_id') ? '' : 'disabled' }}>
                            <option selected disabled hidden value="">
                                {{ old('governorate_id') ? 'جاري التحميل...' : 'اختر المدينة' }}</option>
                            {{-- سيُملأ بالـJS --}}
                        </select>
                        @error('city_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- الهاتف --}}
                        <input type="text" class="form-control mt-3 @error('phone') is-invalid @enderror" name="phone"
                            id="phone" placeholder="رقم الهاتف" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- آخر تاريخ تبرع --}}
                        <input class="form-control mt-3 @error('last_donation_at') is-invalid @enderror"
                            name="last_donation_at" id="donation_date" type="date" value="{{ old('last_donation_at') }}"
                            placeholder="آخر تاريخ تبرع">
                        @error('last_donation_at')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- كلمة المرور --}}
                        <input type="password" class="form-control mt-3 @error('password') is-invalid @enderror"
                            name="password" id="password" placeholder="كلمة المرور">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- تأكيد كلمة المرور --}}
                        <input type="password" class="form-control mt-3" name="password_confirmation"
                            id="password_confirmation" placeholder="تأكيد كلمة المرور">

                        <div class="create-btn mt-4">
                            <input type="submit" value="إنشاء">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
