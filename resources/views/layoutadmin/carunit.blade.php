@extends('layoutadmin.index')
@section('title', 'Data Mobil')
@section('css')
@endsection
@section('body')
<div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Team</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Unit Mobil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4 class="card-title">Tabel Data Unit Mobil</h4></div>
                            <div class="col-md-6 text-right">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus"></i> Tambah Team</button>
                            </div>
                        </div>
                        <div class="table-responsive">
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
                        </table>
                            <!-- Tambah Modal -->
                            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Unit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
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
<script>
    $(document).ready(function() {
        $('#carUnitTable').DataTable({
            serverSide: false,
            deferRender: false,
            responsive:true,
            "paging": true, // Aktifkan paginasi
            "info": true, // Aktifkan informasi jumlah entri yang ditampilkan
            "lengthMenu": [5, 10, 25, 50], // Menentukan opsi panjang halaman
            "pageLength": 5 
        });
    });
</script>
@endsection