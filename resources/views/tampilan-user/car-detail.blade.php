@extends('layout-user.index')
@section('title', 'Halaman Utama')
@section('css')
<style>
    .border-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 16px;
    }
    .border-table td,
    .border-table th {
        border-bottom: 1px solid #ddd;
        padding: 8px;
        font-weight: bold; 
    }
    .border-table th {
        text-align: left;
    }
    .title {
        margin-bottom: 20px; 
        margin-top: 20px;
    }
    .table-container {
        border: 1px solid #000;
        padding: 10px; 
        margin-top: 20px; 
    }
    .description{
      font-size: 16px;
    }
    .btn-round {
    border-radius: 15px;
    }
    .cover-image {
    position: relative;
    display: block;
    overflow: hidden;
    width: 100%;
    height: 0;
    padding-top: calc(400 / 630 * 100%);
    background-image: url('{{ asset('storage/'.$carUnit->photos->first()->file_path) }}');
    background-size: cover;
    background-position: center center;
    transition: filter 0.3s ease, transform 0.3s ease;
    transform-origin: center center;
    border-radius: 10px; 
    }
    .cover-image::before {
        content: 'Lihat Foto Lengkap';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        opacity: 1;
        transition: opacity 0.3s ease;
    }
    .cover-image:hover::before {
        opacity: 0;
    }
    .cover-image:hover {
        filter: brightness(80%);
        transform: scale(1.1);
    }
</style>
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
                <button class="btn btn-success btn-block btn-round" style="padding: 10px 0;"><i class="fa fa-phone"></i> Chat Admin</button>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-block btn-round" style="padding: 10px 0;"><i class="fa fa-calendar"></i> Check Unit & Test Drive</button>
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
@endsection
@section('js')

<script>
$(document).ready(function() {
    $('.gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] 
        },
        zoom: {
            enabled: true,
            duration: 300, 
            easing: 'ease-in-out', 
            opener: function(openerElement) {
                return openerElement.closest('.gallery').find('.cover-image');
            },
            image: {
                verticalFit: true, 
                fitContainerWidth: true
            }
        },
        callbacks: {
            resize: function() {
                var self = this;
                setTimeout(function() {
                    self.wrap.addClass('mfp-image-loaded');
                }, 16);
            },
            imageLoadComplete: function() {
                var self = this;
                setTimeout(function() {
                    self.wrap.addClass('mfp-image-loaded');
                }, 16);
            }
        }
    });
});
</script>

@endsection
