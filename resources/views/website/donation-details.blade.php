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
                            <li class="breadcrumb-item active" aria-current="page">{{ $donation->patient_name }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="details">
                    <div class="person">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>الإسم</p>
                                        </div>
                                        <div class="light">
                                            <p>{{ $donation->patient_name }}</p>
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
                                            <p dir="ltr">{{ $donation->bloodType->name }}</p>
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
                                            <p>{{ $donation->patient_age }} عام</p>
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
                                            <p>{{ $donation->bags_number }} أكياس</p>
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
                                            <p>{{ $donation->hospital_name }}</p>
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
                                            <p>{{ $donation->patient_phone }}</p>
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
                                            <p>{{ $donation->hospital_address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- person -->

                    <div class="text">
                        <p>{{ $donation->notes }}</p>
                    </div>

                    <div id="donation-map" class="location"></div>

                    @if (empty($donation->latitude) || empty($donation->longitude))
                        <div class="alert alert-warning mt-3 text-center">
                            لم يتم تحديد موقع المستشفى على الخريطة بعد. سيتم عرض موقع افتراضي (القاهرة).
                        </div>
                    @endif
                </div><!-- details -->
            </div><!-- container -->
        </div><!-- ask-donation -->
    </div><!-- inside-request -->

    {{-- Leaflet CSS/JS from unpkg (no jQuery required) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Safely pass PHP data to JS
            const donation = {!! json_encode(
                [
                    'lat' => $donation->latitude,
                    'lng' => $donation->longitude,
                    'hospital_name' => $donation->hospital_name,
                    'hospital_address' => $donation->hospital_address,
                ],
                JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT,
            ) !!};

            // Default to Cairo if no coords provided
            const fallback = {
                lat: 30.0444,
                lng: 31.2357
            };
            const hasCoords = Number.isFinite(parseFloat(donation.lat)) && Number.isFinite(parseFloat(donation
                .lng));
            const center = hasCoords ? [parseFloat(donation.lat), parseFloat(donation.lng)] : [fallback.lat,
                fallback.lng
            ];

            // Init map
            const map = L.map('donation-map', {
                zoomControl: true,
                attributionControl: true,
            }).setView(center, hasCoords ? 13 : 11);

            // Base tiles (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Marker and popup
            const title = donation.hospital_name ? donation.hospital_name : 'الموقع';
            const addr = donation.hospital_address ? donation.hospital_address : '—';

            const marker = L.marker(center).addTo(map);
            marker.bindPopup(`<strong>${title}</strong><br>${addr}`).openPopup();

            // Optional: "Open in Google Maps" link in popup
            const gmapsUrl = `https://www.google.com/maps?q=${center[0]},${center[1]}`;
            marker.setPopupContent(
                `<strong>${title}</strong><br>${addr}<br><a href="${gmapsUrl}" target="_blank" rel="noopener">فتح في خرائط Google</a>`
            );
        });
    </script>
@endsection
