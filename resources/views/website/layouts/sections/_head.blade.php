<!doctype html>
<html lang="en" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="icon" href="{{ asset('website/assets/imgs/Icon.png') }}">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{ asset('website/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/owl.theme.default.min.css') }}">

    {{-- for the map  --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <!--style css-->
    <link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}">

    <script>
        window.laravelurl = "{{ url('/') }}";
        window.websiteAjaxCities = "{{ route('website.ajax.cities') }}";
    </script>

    <title>Blood Bank</title>
</head>

<body>
