@extends('layoutadmin.index')
@section('title', 'Dashboard')
@section('css')
@endsection
@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Car Unit</div>
                <div class="card-body" style="overflow-x: auto;" >
                    <table id="carUnitTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Brand</th>
                                <th>Kategori</th>
                                <th>Tahun</th>
                                <th>Bahan Bakar</th>
                                <th>Jumlah Tempat Duduk</th>
                                <th>Garansi</th>
                                <th>Warna</th>
                                <th>Kilometer</th>
                                <th>Kapasitas Mesin (CC)</th>
                                <th>Buku Servis</th>                            
                                <th>Kunci Cadangan</th>
                                <th>Dokumen</th>
                                <th>Masa Panjang STNK</th>
                                <th>Description</th>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carUnits as $carUnit)
                            <tr>
                                <td>{{ $carUnit->id }}</td>
                                <td>{{ $carUnit->name }}</td>
                                <td>{{ $carUnit->price }}</td>
                                <td>{{ $carUnit->brand->name }}</td>
                                <td>{{ $carUnit->category->name }}</td>
                                <td>{{ $carUnit->year }}</td>
                                <td>{{ $carUnit->fuel_type }}</td>
                                <td>{{ $carUnit->seat }}</td>
                                <td>{{ $carUnit->warranty }}</td>
                                <td>{{ $carUnit->color }}</td>
                                <td>{{ $carUnit->mileage }} KM</td>
                                <td>{{ $carUnit->engine_cc }} cc</td>
                                <td>{{ $carUnit->service_book ? 'Ya' : 'Tidak' }}</td>
<td>{{ $carUnit->spare_key ? 'Ya' : 'Tidak' }}</td>
<td>{{ $carUnit->unit_document ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $carUnit->stnk_validity_period }}</td>
                                <td>{{ $carUnit->description }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Brand</th>
        <th>Kategori</th>
        <th>Tahun</th>
        <th>Bahan Bakar</th>
        <th>Jumlah Tempat Duduk</th>
        <th>Garansi</th>
        <th>Warna</th>
        <th>Kilometer</th>
        <th>Kapasitas Mesin (CC)</th>
        <th>Buku Servis</th>                            
        <th>Kunci Cadangan</th>
        <th>Dokumen</th>
        <th>Masa Panjang STNK</th>
        <th>Description</th>
    </tr>
</tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#carUnitTable').DataTable();
    });
</script>
@endsection