@extends('layout-user.index')
@section('title', 'Halaman Utama')
@section('css')
@endsection
@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px">
<div class="row">
    <div class="col-7">
        @foreach ($carUnit->photos->take(1) as $photo)
        <img style="width: 100%; height: auto; max-width: 630px; max-height: 400px;" src="{{ asset('storage/'.$photo->file_path) }}" alt="">
        @endforeach
    </div>
    <div class="col-5">
        <h3>{{$carUnit->name}}</h3>
        <p class="text-secondary fw-normal">{{$carUnit->year}} - {{$carUnit->mileage}} Km - {{$carUnit->transmission}} - {{$carUnit->fuel_type}}</p>
        <p class="fs-2">Rp. {{$carUnit->price}}</p>
        <div class="row ms-1 mt-4" style="display: flex; flex-wrap: wrap;">
            <div class="col-5 btn btn-primary me-2" style="flex: 0 0 auto; width: 41.66666667%;"><i class="fa fa-heart"></i> Suka</div>
            <div class="col-5 btn btn-primary" style="flex: 0 0 auto; width: 41.66666667%;"><i class="fa fa-share"></i> Bagikan</div>
        </div>
        <div class="row ms-1 mt-4" style="display: flex; flex-wrap: wrap;">
            <div class="col-10 btn btn-primary me-2" style="flex: 0 0 auto; width: 83.33333333%;"><i class="fa fa-phone"></i> Chat Admin</div>
        </div>
        <div class="row ms-1 mt-4" style="display: flex; flex-wrap: wrap;">
            <div class="col-10 btn btn-primary me-2" style="flex: 0 0 auto; width: 83.33333333%;"><i class="fa fa-calendar"></i> Check Unit & Test Drive</div>
        </div>
        <p class="fs-4 mt-5">Butuh bantuan? hubungi kami melalui <a href="">whatsapp</a></p>
    </div>
</div>
    <div class="mt-5 border boder-dark p-5">
        <h3 class="text-center mb-5"><u>Detail Mobil</u></h3>
        <table class="table">
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
    <div class="mt-5 border boder-dark p-5">
        <h3 class="text-center mb-5"><u>Deskripsi</u></h3>
        <p class="fs-4">{{$carUnit->description}}</p>
    </div>
</div>
@endsection
@section('js')
<script>
    var assetUrl = "{{ asset('storage/') }}";
</script>
<script src="{{ asset('user/modal/quick-view.js') }}"></script>
@endsection