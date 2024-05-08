@extends('layout-admin.index')
@section('title', 'Dashboard')
@section('css')
<link href="{{ asset('admin/css/check-units.css') }}" rel="stylesheet">
@endsection
@section('body')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permintaan Jadwal Cek Unit</li>
        </ol>
    </nav>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
        @foreach($checkUnits as $checkUnit)
        <div class="col-md-3" style="margin-bottom: 25px;">
            <div class="card custom-card">
                <div class="row g-0">
                    <div class="car-img-wrapper">
                        @foreach ($checkUnit->carUnit->photos->take(1) as $photo)
                        <img src="{{ asset('storage/'.$photo->file_path) }}" alt="Gambar Mobil" class="img-fluid car-img">
                        @endforeach
                        <span class="status card-status @if($checkUnit->status == 'Menunggu Persetujuan') waiting-approval @elseif($checkUnit->status == 'Ditolak') canceled @elseif($checkUnit->status == 'Disetujui') approved @else approved @endif">
                            {{ $checkUnit->status }}
                        </span>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <h5 class="card-title name car-name" data-id="{{ $checkUnit->id }}"><b>{{ $checkUnit->carUnit->name }}</b></h5>
                    <p class="card-text name"><i class="fa fa-user"></i> {{ $checkUnit->user->name }}</p>
                    <p class="card-text name"><i class="fa fa-phone"></i> {{ $checkUnit->user->phone }}</p>
                    <p class="card-text name"><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($checkUnit->date)->format('d-m-Y') }}, {{ $checkUnit->time }} WIB</p>
                </div>
                <div class="card-footer" style="display: grid; grid-template-rows: auto auto;">
                    <button class="btn btn-outline-primary btn-sm detail-button" data-id="{{ $checkUnit->id }}"><i class="fa fa-eye"></i> Lihat Detail</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailModal{{ $checkUnit->id }}" role="dialog" tabindex="-1" aria-labelledby="detailModalLabel{{ $checkUnit->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $checkUnit->id }}">Detail Check Unit  {{ $checkUnit->carUnit->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.detail-button').click(function() {
            var checkUnitId = $(this).data('id');
            $('#detailModal' + checkUnitId).modal('show');
        });
        $('.car-name').click(function() {
            var checkUnitId = $(this).data('id');
            $('#detailModal' + checkUnitId).modal('show');
        });
    });
</script>
@endsection

