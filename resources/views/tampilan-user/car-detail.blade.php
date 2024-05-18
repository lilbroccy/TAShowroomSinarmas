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
                <i class="fa fa-calendar"></i> Cek Unit & Test Drive
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
                <h5 class="modal-title" id="checkUnitModalLabel">Form Cek Unit & Test Drive</h5>
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
                    
                    @if(auth()->check())
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
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="agreement">
                                <label class="form-check-label" for="agreement">
                                    Saya menyetujui 
                                    <u><a href="#" data-toggle="modal" data-target="#termsModal">persyaratan dan ketentuan</a></u>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="simpanButton">Kirim</button>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="name">Nama Anda:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon Anda:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda">
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
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="agreement">
                            <label class="form-check-label" for="agreement">
                                Saya menyetujui 
                                <u><a href="#" data-toggle="modal" data-target="#termsModal">persyaratan dan ketentuan</a></u>
                            </label>
                        </div>
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
                        <button type="button" class="btn btn-primary" id="simpanButton">Kirim</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Persyaratan dan Ketentuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Berikut adalah persyaratan dan ketentuan terkait dengan layanan Cek Unit & Test Drive:
                </p>
                <ol>
                    <li>1. Biaya cek unit sebesar Rp15.000 akan dikenakan untuk biaya operasional.</li>
                    <li>2. Jika jadwal cek unit dibatalkan oleh pengguna, biaya cek unit tidak dapat dikembalikan.</li>
                    <li>3. Jika unit mobil yang dipilih terjual sebelum jadwal cek unit, biaya cek unit akan dikembalikan dengan konfirmasi melalui WhatsApp kami.</li>
                    <li>4. Test drive hanya dilakukan di sekitar lokasi showroom.</li>
                    <li>5. Test drive harus didampingi oleh perwakilan dari pihak kami.</li>
                    <li>6. Durasi dan rute test drive akan ditentukan oleh perwakilan kami.</li>
                    <li>7. Pengguna harus mematuhi semua aturan lalu lintas dan instruksi dari perwakilan kami selama test drive.</li>
                    <li>8. Kami berhak untuk menolak atau menghentikan test drive jika ada pelanggaran aturan atau perilaku tidak aman.</li>
                    <li>9. Kami tidak bertanggung jawab atas kecelakaan atau kerusakan selama test drive, kecuali disebabkan oleh kelalaian dari perwakilan kami.</li>
                    <li>10. Pengguna harus memiliki lisensi mengemudi yang valid dan memenuhi syarat-syarat lain yang mungkin diperlukan oleh peraturan setempat.</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var isAuthenticated = @json(auth()->check());
</script>
<script src="{{ asset ('user/modal/car-detail.js') }}"></script>
@endsection
