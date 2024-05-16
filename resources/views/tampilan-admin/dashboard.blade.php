@extends('layout-admin.index')
@section('title', 'Dashboard')
@section('css')
<link href="{{ asset ('admin/css/callout.css') }}" rel="stylesheet">
@endsection
@section('body')
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <div class="text-end upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/monsteradmin/"
                                class="btn btn-success d-none d-md-inline-block text-white" target="_blank">Upgrade to
                                Pro</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('dashboard') }}">
                                    <div class="d-md-flex align-items-center">
                                        <h4 class="card-title col-md-6 mb-md-0 mb-3">Data</h4>
                                        <div class="col-md-6 form-group d-flex">
                                            <select name="month" class="form-select shadow-none flex-grow-1" onchange="this.form.submit()">
                                                <option value="1" {{ request('month', now()->month) == 1 ? 'selected' : '' }}>Januari</option>
                                                <option value="2" {{ request('month', now()->month) == 2 ? 'selected' : '' }}>Februari</option>
                                                <option value="3" {{ request('month', now()->month) == 3 ? 'selected' : '' }}>Maret</option>
                                                <option value="4" {{ request('month', now()->month) == 4 ? 'selected' : '' }}>April</option>
                                                <option value="5" {{ request('month', now()->month) == 5 ? 'selected' : '' }}>Mei</option>
                                                <option value="6" {{ request('month', now()->month) == 6 ? 'selected' : '' }}>Juni</option>
                                                <option value="7" {{ request('month', now()->month) == 7 ? 'selected' : '' }}>Juli</option>
                                                <option value="8" {{ request('month', now()->month) == 8 ? 'selected' : '' }}>Agustus</option>
                                                <option value="9" {{ request('month', now()->month) == 9 ? 'selected' : '' }}>September</option>
                                                <option value="10" {{ request('month', now()->month) == 10 ? 'selected' : '' }}>Oktober</option>
                                                <option value="11" {{ request('month', now()->month) == 11 ? 'selected' : '' }}>November</option>
                                                <option value="12" {{ request('month', now()->month) == 12 ? 'selected' : '' }}>Desember</option>
                                            </select>
                                            <select name="year" class="form-select shadow-none ml-2" onchange="this.form.submit()">
                                                @for ($i = now()->year; $i >= 2020; $i--)
                                                    <option value="{{ $i }}" {{ request('year', now()->year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="bd-callout bd-callout-info shadow">
                                            <h4 class="d-flex justify-content-between align-items-center"> 
                                                Unit Tersedia 
                                                <i class="fa fa-car"></i>
                                            </h4>
                                            <div class="text-end">
                                                <h2 class="font-light mb-0">{{ $totalUnits }}</h2>
                                                <span class="text-muted">Unit Tersedia</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="bd-callout bd-callout-warning shadow">
                                            <h4 class="d-flex justify-content-between align-items-center"> 
                                                Penjualan Bulan Ini
                                                <i class="fa fa-line-chart"></i>
                                            </h4>
                                            <div class="text-end">
                                                <h2 class="font-light mb-0">{{ $totalSales }}</h2>
                                                <span class="text-muted">Penjualan Bulan Ini</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="bd-callout bd-callout-danger shadow">
                                            <h4 class="d-flex justify-content-between align-items-center"> 
                                                Akun Terdaftar 
                                                <i class="fa fa-users"></i>
                                            </h4>
                                            <div class="text-end">
                                                <h2 class="font-light mb-0">{{ $totalUser }}</h2>
                                                <span class="text-muted">Akun Terdaftar</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <div class="bd-callout bd-callout-default shadow">
                                            <h4 class="d-flex justify-content-between align-items-center"> 
                                                Omset Bulan Ini
                                                <i class="fa fa-money"></i>
                                            </h4>
                                            <div class="text-end">
                                                    <h2 class="font-light mb-0">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</h2>
                                                    <span class="text-muted">Omset Bulan Ini</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Revenue Statistics</h4>
                                <div class="flot-chart">
                                    <div class="flot-chart-content " id="flot-line-chart"
                                        style="padding: 0px; position: relative;">
                                        <canvas class="flot-base w-100" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                </div>
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Projects of the Month</h4>
                                    <div class="col-md-2 ms-auto">
                                        <select class="form-select shadow-none col-md-2 ml-auto">
                                            <option selected>January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive mt-5">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0" colspan="2">Assigned</th>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">Budget</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width:50px;"><span class="round">S</span></td>
                                                <td class="align-middle">
                                                    <h6>Sunil Joshi</h6><small class="text-muted">Web Designer</small>
                                                </td>
                                                <td class="align-middle">Elite Admin</td>
                                                <td class="align-middle">$3.9K</td>
                                            </tr>
                                            <tr class="active">
                                                <td><span class="round"><img src="../assets/images/users/2.jpg"
                                                            alt="user" width="50"></span></td>
                                                <td class="align-middle">
                                                    <h6>Andrew</h6><small class="text-muted">Project Manager</small>
                                                </td>
                                                <td class="align-middle">Real Homes</td>
                                                <td class="align-middle">$23.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-success">B</span></td>
                                                <td class="align-middle">
                                                    <h6>Bhavesh patel</h6><small class="text-muted">Developer</small>
                                                </td>
                                                <td class="align-middle">MedicalPro Theme</td>
                                                <td class="align-middle">$12.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-primary">N</span></td>
                                                <td class="align-middle">
                                                    <h6>Nirav Joshi</h6><small class="text-muted">Frontend Eng</small>
                                                </td>
                                                <td class="align-middle">Elite Admin</td>
                                                <td class="align-middle">$10.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-warning">M</span></td>
                                                <td class="align-middle">
                                                    <h6>Micheal Doe</h6><small class="text-muted">Content Writer</small>
                                                </td>
                                                <td class="align-middle">Helping Hands</td>
                                                <td class="align-middle">$12.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-danger">N</span></td>
                                                <td class="align-middle">
                                                    <h6>Johnathan</h6><small class="text-muted">Graphic</small>
                                                </td>
                                                <td class="align-middle">Digital Agency</td>
                                                <td class="align-middle">$2.6K</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent blogss -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <!-- Column -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/images/big/img1.jpg" alt="Card">
                            <div class="card-body">
                                <ul class="list-inline d-flex align-items-center">
                                    <li class="ps-0">20 May 2021</li>
                                    <li class="ms-auto"><a href="javascript:void(0)" class="link">3 Comment</a></li>
                                </ul>
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/images/big/img2.jpg" alt="Card">
                            <div class="card-body">
                                <ul class="list-inline d-flex align-items-center">
                                    <li class="ps-0">20 May 2021</li>
                                    <li class="ms-auto"><a href="javascript:void(0)" class="link">3 Comment</a></li>
                                </ul>
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/images/big/img4.jpg" alt="Card">
                            <div class="card-body">
                                <ul class="list-inline d-flex align-items-center">
                                    <li class="ps-0">20 May 2021</li>
                                    <li class="ms-auto"><a href="javascript:void(0)" class="link">3 Comment</a></li>
                                </ul>
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- Recent blogss -->
                <!-- ============================================================== -->
            </div>
@endsection
@section('js')
@endsection