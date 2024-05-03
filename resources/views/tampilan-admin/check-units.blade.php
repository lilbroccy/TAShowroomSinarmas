@extends('layout-admin.index')
@section('title', 'Dashboard')
@section('css')
<link href="{{ asset('admin/css/check-units.css') }}" rel="stylesheet">
@endsection
@section('body')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Permintaan Jadwal Cek Unit</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permintaan Jadwal Cek Unit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
    <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="row g-0">
                    <div class="car-img-wrapper">
                        <img src="{{asset('user/img/photos/11.jpg')}}" alt="Gambar Mobil" class="img-fluid car-img">
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <!-- Data Mobil -->
                    <h5 class="card-title"><b>Pajero Sport Dakar 4x4 Diesel</b></h5>
                    <p class="card-text"><i class="fa fa-user"></i> Roni</p>
                    <p class="card-text"><i class="fa fa-phone"></i> 085156585108</p>
                    <p class="card-text"><i class="fa fa-calendar"></i> Senin, 28-04-2024, 17.00 WIB</p>
                    <span class="status waiting-approval">
                        Menunggu Persetujuan
                    </span> 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="row g-0">
                    <div class="car-img-wrapper">
                        <img src="{{asset('user/img/photos/11.jpg')}}" alt="Gambar Mobil" class="img-fluid car-img">
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <!-- Data Mobil -->
                    <h5 class="card-title"><b>Pajero Sport Dakar 4x4 Diesel</b></h5>
                    <p class="card-text"><i class="fa fa-user"></i> Roni</p>
                    <p class="card-text"><i class="fa fa-phone"></i> 085156585108</p>
                    <p class="card-text"><i class="fa fa-calendar"></i> Senin, 28-04-2024, 17.00 WIB</p>
                    <span class="status waiting-approval">
                        Menunggu Persetujuan
                    </span> 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="row g-0">
                    <div class="car-img-wrapper">
                        <img src="{{asset('user/img/photos/11.jpg')}}" alt="Gambar Mobil" class="img-fluid car-img">
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <!-- Data Mobil -->
                    <h5 class="card-title"><b>Pajero Sport Dakar 4x4 Diesel</b></h5>
                    <p class="card-text"><i class="fa fa-user"></i> Roni</p>
                    <p class="card-text"><i class="fa fa-phone"></i> 085156585108</p>
                    <p class="card-text"><i class="fa fa-calendar"></i> Senin, 28-04-2024, 17.00 WIB</p>
                    <span class="status approved">
                        Disetujui
                    </span> 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="row g-0">
                    <div class="car-img-wrapper">
                        <img src="{{asset('user/img/photos/11.jpg')}}" alt="Gambar Mobil" class="img-fluid car-img">
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <!-- Data Mobil -->
                    <h5 class="card-title"><b>Pajero Sport Dakar 4x4 Diesel</b></h5>
                    <p class="card-text"><i class="fa fa-user"></i> Roni</p>
                    <p class="card-text"><i class="fa fa-phone"></i> 085156585108</p>
                    <p class="card-text"><i class="fa fa-calendar"></i> Senin, 28-04-2024, 17.00 WIB</p>
                    <span class="status canceled">
                        Ditolak
                    </span> 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="row g-0">
                    <div class="car-img-wrapper">
                        <img src="{{asset('user/img/photos/11.jpg')}}" alt="Gambar Mobil" class="img-fluid car-img">
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <!-- Data Mobil -->
                    <h5 class="card-title"><b>Pajero Sport Dakar 4x4 Diesel</b></h5>
                    <p class="card-text"><i class="fa fa-user"></i> Roni</p>
                    <p class="card-text"><i class="fa fa-phone"></i> 085156585108</p>
                    <p class="card-text"><i class="fa fa-calendar"></i> Senin, 28-04-2024, 17.00 WIB</p>
                    <span class="status canceled">
                        Ditolak
                    </span> 
                </div>
            </div>
        </div>
    </div>
</div>


@endsection