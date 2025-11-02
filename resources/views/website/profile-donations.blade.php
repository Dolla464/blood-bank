@extends('website.layouts.app')

@section('content')
<div class="donation-requests">
    <div class="all-requests">
        <div class="container">

            {{-- المسار --}}
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات التبرع الخاصة بي</li>
                    </ol>
                </nav>
            </div>

            <!-- الطلبات -->
            <div class="requests">
                <div class="head-text">
                    <h2>طلباتي</h2>
                </div>

                <div class="content">
                    {{-- ⚙️ نموذج الفلاتر --}}
                    <form class="row filter" method="GET" action="{{ route('website.profile.donations') }}">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" id="blood_type_select" name="blood_type_id">
                                        <option value="" {{ request('blood_type_id') ? '' : 'selected' }} hidden>اختر فصيلة الدم</option>
                                        <option value="">كل الفصائل</option>
                                        @foreach ($bloodTypes as $bloodType)
                                            <option value="{{ $bloodType->id }}"
                                                {{ (string) request('blood_type_id') === (string) $bloodType->id ? 'selected' : '' }}>
                                                {{ $bloodType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" id="city_select" name="city_id">
                                        <option value="" {{ request('city_id') ? '' : 'selected' }} hidden>اختر المدينة</option>
                                        <option value="">كل المدن</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ (string) request('city_id') === (string) $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    {{-- 🩸 الطلبات --}}
                    <div class="patients mt-4">
                        @if ($clientDonations->count())
                            @foreach ($clientDonations as $donation)
                                <div class="details">
                                    <div class="blood-type">
                                        <h2 dir="ltr">{{ $donation->bloodType->name }}</h2>
                                    </div>
                                    <ul>
                                        <li><span>اسم الحالة:</span> {{ $donation->patient_name }}</li>
                                        <li><span>المستشفى:</span> {{ $donation->hospital_name }}</li>
                                        <li><span>المدينة:</span> {{ $donation->city->name }}</li>
                                    </ul>
                                    <a href="{{ route('website.donation-details', $donation->id) }}">التفاصيل</a>
                                </div>
                            @endforeach

                            <div class="pages mt-4 d-flex justify-content-center" dir="rtl">
                                {{ $clientDonations->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <div class="alert alert-info mt-4 text-center">
                                لا توجد نتائج مطابقة لخيارات البحث الحالية.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
