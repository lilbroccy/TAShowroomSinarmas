@extends('layout-admin.index')
@section('title', 'Dashboard')
@section('css')

<link href="{{ asset('admin/css/check-units.css') }}" rel="stylesheet">
<link href="{{ asset('user/css/font-awesome.min.css') }}" rel="stylesheet">
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
                    <p class="card-text name user" data-id="{{ $checkUnit->user->id }}"><i class="fa fa-user-o"></i>&nbsp;:&nbsp; {{ $checkUnit->user->name }}</p>
                    <p class="card-text name whatsapp-link" data-phone="{{ $checkUnit->user->phone }}"><i class="fa fa-whatsapp"></i>&nbsp;:&nbsp; {{ $checkUnit->user->phone }}</p>
                    <p class="card-text name date"><i class="fa fa-calendar"></i>&nbsp;:&nbsp; {{ \Carbon\Carbon::parse($checkUnit->date)->format('d-m-Y') }}</p>
                    <p class="card-text name time"><i class="fa fa-clock-o"></i>&nbsp;:&nbsp; {{ $checkUnit->time }} WIB</p>
                </div>
                <div class="card-footer" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                    <button class="btn btn-outline-primary btn-sm detail-button" data-id="{{ $checkUnit->id }}"><i class="fa fa-eye"></i> Detail</button>
                    <button class="btn btn-outline-info btn-sm action-button" data-id="{{ $checkUnit->id }}"><i class="fa fa-cogs"></i> Opsi</button>
                    @if($checkUnit->status == 'Disetujui')
                        <button class="btn btn-outline-success btn-sm done-button" data-id="{{ $checkUnit->id }}"><i class="fa fa-check"></i> Selesai</button>
                    @endif
                </div>

            </div>
        </div>
        <div class="modal fade" id="detailModal{{ $checkUnit->id }}" role="dialog" tabindex="-1" aria-labelledby="detailModalLabel{{ $checkUnit->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $checkUnit->id }}">Detail Cek Unit  {{ $checkUnit->carUnit->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="color: black;"><b>Tanggal & Waktu Cek Unit:</b> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $checkUnit->date)->format('d-m-Y') }}, {{ $checkUnit->time}} (WIB)</p>
                        <p style="color: black;"><b>Nama Mobil:</b> {{ $checkUnit->carUnit->name }}</p>
                        <p style="color: black;"><b>Harga:</b> {{ $checkUnit->carUnit->price }}</p>
                        <p style="color: black;"><b>Nama Pengguna:</b> {{ $checkUnit->user->name }}</p>
                        <p style="color: black;"><b>Nomor Telepon:</b> {{ $checkUnit->user->phone }}</p>
                        <p style="color: black;"><b>Email:</b> {{ $checkUnit->user->email }}</p>
                        <p style="color: black;"><b>Catatan Tambahan Pengguna :</b> {{ $checkUnit->note }}</p>
                        </br>
                        </br>
                        </br>
                        @if ($checkUnit->status === 'Ditolak' || $checkUnit->status === 'Disetujui')
                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <p style="font-size: 12px;">Terakhir Diubah Oleh: {{ $checkUnit->lastEditBy->name }}, {{ $checkUnit->updated_at->format('d-m-Y H:i:s')}} (WIB)</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="userProfileModal{{ $checkUnit->user->id }}" role="dialog" tabindex="-1" aria-labelledby="userProfileModalLabel{{ $checkUnit->user->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userProfileModalLabel{{ $checkUnit->user->id }}">Profil Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p>Nama: {{ $checkUnit->user->name }}</p>
                    <p>Nomor Telepon: {{ $checkUnit->user->phone }}</p>
                    <p>Email: {{ $checkUnit->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('admin/modal/check-unit.js')}}"></script>
<script>
</script>
@endsection

