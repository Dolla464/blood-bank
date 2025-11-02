<!--requests-->
<div class="requests">
    <div class="container">
        <div class="head-text">
            <h2>طلبات التبرع</h2>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <form class="row filter method="Get" action="{{ route('website.donation-requests') }}">
                <div class="col-md-5 blood">
                    <div class="form-group">
                        <div class="inside-select">
                            <select class="form-control" id="blood_type_select" name="blood_type_id">
                                <option value="" {{ request('blood_type_id') ? '' : 'selected' }} disabled hidden>اختر فصيلة الدم</option>
                                <option value="">كل الفصائل</option>
                                @foreach ($bloodTypes as $bloodType)
                                    <option value="{{ $bloodType->id }}" {{ (string)request('blood_type_id') === (string)$bloodType->id ? 'selected' : '' }}>{{ $bloodType->name }}
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
                                <option value="{{ request('city_id') ? '' : 'selected' }}" disabled hidden>اختر المدينة</option>
                                <option value="">كل المدن</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ (string)request('city_id') === (string)$city->id ? 'selected' : '' }}>{{ $city->name }}</option>
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
            <div class="patients">
                @foreach ($donations as $donation)
                    <div class="details">
                        <div class="blood-type">
                            <h2 dir="ltr">{{ $donation->bloodType->name }}</h2>
                        </div>
                        <ul>
                            <li><span>اسم الحالة:</span>{{ $donation->patient_name }}</li>
                            <li><span>مستشفى:</span>{{ $donation->hospital_name }}</li>
                            <li><span>المدينة:</span>{{ $donation->city->name }}</li>
                        </ul>
                        <a href="{{ route('website.donation-details', $donation->id) }}">التفاصيل</a>
                    </div>
                @endforeach
            </div>
            <div class="more">
                <a href="{{ route('website.donation-requests') }}">المزيد</a>
            </div>
        </div>
    </div>
</div>
