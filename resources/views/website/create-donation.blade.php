@extends('website.layouts.app')

@section('content')
    <style>
        #donation-map {
            height: 500px;
            border-radius: 12px;
            overflow: hidden;
        }
    </style>

    <div class="inside-request">
        <div class="ask-donation">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('website.donation-requests') }}">طلبات التبرع</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">طلب تبرع جديد</li>
                        </ol>
                    </nav>
                </div>

                <div class="details">
                    {{-- ✅ نموذج إنشاء طلب جديد --}}
                    <form action="#" method="POST">
                        @csrf
                        <div class="person">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="inside">
                                        <div class="info">
                                            <div class="dark">
                                                <p>الإسم</p>
                                            </div>
                                            <div class="light">
                                                <input type="text" name="patient_name" class="form-control"
                                                    placeholder="أدخل اسم المريض" value="{{ old('patient_name') }}">
                                                @error('patient_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="inside">
                                        <div class="info">
                                            <div class="dark">
                                                <p>فصيلة الدم</p>
                                            </div>
                                            <div class="light">
                                                <select name="blood_type_id" class="form-control">
                                                    <option value="">اختر فصيلة الدم</option>
                                                    @foreach ($bloodTypes as $type)
                                                        <option value="{{ $type->id }}"
                                                            {{ old('blood_type_id') == $type->id ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="inside">
                                        <div class="info">
                                            <div class="dark">
                                                <p>العمر</p>
                                            </div>
                                            <div class="light">
                                                <input type="number" name="patient_age" class="form-control"
                                                    placeholder="أدخل عمر المريض" value="{{ old('patient_age') }}">
                                                @error('patient_age')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="inside">
                                        <div class="info">
                                            <div class="dark">
                                                <p>عدد الأكياس المطلوبة</p>
                                            </div>
                                            <div class="light">
                                                <input type="number" name="bags_number" class="form-control"
                                                    placeholder="عدد الأكياس" value="{{ old('bags_number') }}">
                                                @error('bags_number')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="inside">
                                        <div class="info">
                                            <div class="dark">
                                                <p>المشفى</p>
                                            </div>
                                            <div class="light">
                                                <input type="text" name="hospital_name" class="form-control"
                                                    placeholder="اسم المستشفى" value="{{ old('hospital_name') }}">
                                                @error('hospital_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="inside">
                                        <div class="info">
                                            <div class="dark">
                                                <p>رقم الجوال</p>
                                            </div>
                                            <div class="light">
                                                <input type="text" name="patient_phone" class="form-control"
                                                    placeholder="رقم الجوال" value="{{ old('patient_phone') }}">
                                                @error('patient_phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="inside">
                                        <div class="info">
                                            <div class="special-dark dark">
                                                <p>عنوان المشفى</p>
                                            </div>
                                            <div class="special-light light">
                                                <input type="text" name="hospital_address" class="form-control"
                                                    placeholder="عنوان المستشفى" value="{{ old('hospital_address') }}">
                                                @error('hospital_address')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- person -->

                        <div class="text mb-3">
                            <textarea name="notes" class="form-control" rows="4" placeholder="ملاحظات إضافية">{{ old('notes') }}</textarea>
                        </div>

                        {{-- 🗺️ خريطة لتحديد الموقع --}}
                        <div id="donation-map" class="location mb-3"></div>
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5 py-2">إرسال الطلب</button>
                        </div>
                    </form>
                </div><!-- details -->
            </div><!-- container -->
        </div><!-- ask-donation -->
    </div><!-- inside-request -->

    {{-- Leaflet CSS/JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const defaultCenter = [30.0444, 31.2357]; // القاهرة
            const map = L.map('donation-map').setView(defaultCenter, 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker;

            function setMarker(lat, lng) {
                if (marker) map.removeLayer(marker);
                marker = L.marker([lat, lng]).addTo(map);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }

            // عند الضغط على الخريطة يتم تحديد الموقع
            map.on('click', function(e) {
                setMarker(e.latlng.lat, e.latlng.lng);
            });

            // إذا كان المستخدم وافق على تحديد الموقع الجغرافي
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(pos) {
                    const userLat = pos.coords.latitude;
                    const userLng = pos.coords.longitude;
                    map.setView([userLat, userLng], 13);
                    setMarker(userLat, userLng);
                });
            }
        });
    </script>
@endsection
