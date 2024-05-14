@extends('layout-user.index')
@section('title', 'Halaman Utama')
@section('css')
@php
    $carUnitImagePath = asset('storage/'.$carUnit->photos->first()->file_path);
@endphp
<style>
    :root {
        --car-unit-image: url('{{ $carUnitImagePath }}');
    }
</style>
<link href="{{ asset('user/css/car-detail.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container" style="margin-top: 5px; margin-bottom: 50px">
  <div class="row" style="margin-top: 20px;">
    <div class="col-md-7">
        <div class="gallery">
        <a href="{{ asset('storage/'.$carUnit->photos->first()->file_path) }}" class="cover-image" >
            <img style="width: 100%; height: auto; max-width: 630px; max-height: 400px; display: none;">
        </a>
            @foreach ($carUnit->photos->slice(1) as $photo)
                <a href="{{ asset('storage/'.$photo->file_path) }}"></a>
            @endforeach
        </div>
    </div>
    <div class="col-md-5">
        <h3>{{$carUnit->name}}</h3>
        <p class="text-muted fw-normal"> {{$carUnit->brand->name}} - {{$carUnit->year}} - {{$carUnit->transmission}} - {{$carUnit->fuel_type}}</p>
        <p class="lead"><b>Rp. {{ number_format($carUnit->price, 0, ',', '.') }}</b></p>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-xs-6">
                <button class="btn btn-danger btn-block btn-round" style="padding: 10px 0;"><i class="fa fa-heart"></i> Suka</button>
            </div>
            <div class="col-xs-6">
                <button class="btn btn-info btn-block btn-round" style="padding: 10px 0;"><i class="fa fa-share"></i> Bagikan</button>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-xs-12">
                <button class="btn btn-success btn-block btn-round" style="padding: 10px 0;"><i class="fa fa-comment"></i> Chat Admin</button>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-xs-12">
            <button class="btn btn-primary btn-block btn-round" id="checkUnitBtn" style="padding: 10px 0;">
                <i class="fa fa-calendar"></i> Check Unit & Test Drive
            </button>
            </div>
        </div>
        <p class="lead mt-4">Butuh bantuan? Hubungi kami melalui <a href="#">WhatsApp <i class="fa fa-whatsapp"></i></a></p>
    </div>
</div>
    <div class="table-container"> 
        <div class="mt-5 border border-dark p-5">
            <h3 class="text-center mb-5"><u>Detail Mobil</u></h3>
            <table class="border-table">
                <tbody>
                    <tr>
                        <td class="fw-bold fs-3">Jenis Bahan Bakar</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->fuel_type}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Jenis Transmisi</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->transmission}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Jarak Tempuh Saat Ini</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->mileage}} Km</td>
                    </tr>
                    <tr>
                    <td class="fw-bold fs-3">Jumlah Tempat Duduk</td>
                    <td class="fw-bold fs-3 text-right">{{$carUnit->seat}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Kapasitas Mesin</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->engine_cc}} cc</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Garansi</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->warranty}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Warna</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->color}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Buku Servis</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->service_book == 1 ? 'Ya' : 'Tidak'}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Dokumen</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->unit_document == 1 ? 'Ya' : 'Tidak'}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Kunci Cadangan</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->spare_key == 1 ? 'Ya' : 'Tidak'}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold fs-3">Masa Berlaku STNK</td>
                        <td class="fw-bold fs-3 text-right">{{$carUnit->stnk_validity_period}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="table-container">
      <div class="mt-5 border border-dark p-5">
        <h3 class="text-center mb-5 title"><u>Deskripsi</u></h3>
        <p class="lead description"><b>{{$carUnit->description}}</b></p>
      </div>
    </div>
</div>
<div class="modal fade" id="checkUnitModal" tabindex="-1" role="dialog" aria-labelledby="checkUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkUnitModalLabel">Form Check Unit & Test Drive</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="checkUnitForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="carname">Nama Mobil:</label>
                        <input type="text" class="form-control" id="carname" name="carname" value="{{ $carUnit->name }}" readonly>                    
                        <input type="hidden" id="car_id" name="car_id" value="{{ $carUnit->id }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Anda:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon Anda:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal:</label>
                        <input type="date" class="form-control" id="date" name="date" required min="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="time">Jam (WIB):</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Catatan Tambahan:</label>
                        <textarea class="form-control" id="note" name="note" placeholder="Kosongkan jika tidak ada catatan tambahan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="payment">Pilih Metode Pembayaran: </label>
                        <select class="form-control" id="payment" name="payment" required>
                            <option value="" disabled selected>Pilih metode pembayaran</option>
                            <option value="BCA : 0123456789 a/n Risky">BCA : 0123456789 a/n Risky</option>
                            <option value="DANA : 081234567890">DANA : 081234567890 a/n Risky</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_proof">Unggah Bukti Transfer:</label>
                        <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="simpanButton">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Transfer dan Upload Bukti -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferModalLabel">Form Transfer dan Unggah Bukti Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="transferForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="payment">Pilih Metode Pembayaran: </label>
                        <select class="form-control" id="payment" name="payment" required>
                            <option value="" disabled selected>Pilih metode pembayaran</option>
                            <option value="BCA : 0123456789 a/n Risky">BCA : 0123456789 a/n Risky</option>
                            <option value="DANA : 081234567890">DANA : 081234567890 a/n Risky</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_proof">Unggah Bukti Transfer:</label>
                        <input type="file" class="form-control-file" id="payment_proof" name="payment_proof" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanButton">Lanjutkan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="checkUnitUpdateModal" tabindex="-1" role="dialog" aria-labelledby="checkUnitUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkUnitUpdateModalLabel">Check Unit & Test Drive</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="checkUnitUpdateForm">
                    @csrf
                    <div class="form-group">
                        <label for="carname">Nama Mobil:</label>
                        <input type="text" class="form-control" id="carname" name="carname" value="{{ $carUnit->name }}" readonly>                    
                        <input type="hidden" id="car_id" name="car_id" value="{{ $carUnit->id }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Anda:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon Anda:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal:</label>
                        <input type="date" class="form-control" id="date" name="date" required min="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="time">Jam (WIB):</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Catatan:</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="updateButton">Kirim</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset ('user/modal/car-detail.js') }}"></script>
@endsection
