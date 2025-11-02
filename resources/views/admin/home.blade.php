@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard Home</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- clients count --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('admin.users.index') }}">Clients</a></span>
                        <span class="info-box-number">{{ number_format($clientsCount) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-md-6 -->

            {{-- donations count --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-hand-holding-medical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('admin.donations.index') }}">Donation Requsets</a></span>
                        <span class="info-box-number">{{ number_format($donationsCount) }}</span>
                    </div>
                </div>
            </div>

            {{-- Blood Types --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-tint"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Blood Types</span>
                        <span class="info-box-number">{{ number_format($bloodTypesCount) }}</span>
                    </div>
                </div>
            </div>

            {{-- Cities --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-city"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('admin.cities.index') }}">Cities</a></span>
                        <span class="info-box-number">{{ number_format($citiesCount) }}</span>
                    </div>
                </div>
            </div>

            {{-- Governorates --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-map-marked-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ route('admin.governorates.index') }}">Governorates</a></span>
                        <span class="info-box-number">{{ number_format($governoratesCount) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
