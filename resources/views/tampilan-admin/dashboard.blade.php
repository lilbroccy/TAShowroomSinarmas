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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="d-md-flex align-items-center">
                            <h4 class="card-title col-md-6 mb-md-0 mb-3">Data Penitipan</h4>
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
                                    Unit Titipan Tersedia 
                                    <i class="fa fa-car"></i>
                                </h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{ $totalUnitsTitipan }}</h2>
                                    <span class="text-muted">Unit Titipan Tersedia</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="bd-callout bd-callout-warning shadow">
                                <h4 class="d-flex justify-content-between align-items-center"> 
                                    Penjualan Mobil Titipan Bulan Ini
                                    <i class="fa fa-line-chart"></i>
                                </h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{ $totalSalesTitipan }}</h2>
                                    <span class="text-muted">Penjualan Mobil Titipan Bulan Ini</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="bd-callout bd-callout-danger shadow">
                                <h4 class="d-flex justify-content-between align-items-center"> 
                                    Permintaan Penitipan
                                    <i class="fa fa-check"></i>
                                </h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{ $totalReqUnitsTitipan }}</h2>
                                    <span class="text-muted">Permintaan Penitipan</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="bd-callout bd-callout-default shadow">
                                <h4 class="d-flex justify-content-between align-items-center"> 
                                    Keuntungan Fee Titipan
                                    <i class="fa fa-money"></i>
                                </h4>
                                <div class="text-end">
                                        <h2 class="font-light mb-0">Rp {{ number_format($totalFeeTitipan, 0, ',', '.') }}</h2>
                                        <span class="text-muted">Keuntungan Fee Titipan 2% Dari Harga Mobil</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
@endsection
@section('js')
@endsection