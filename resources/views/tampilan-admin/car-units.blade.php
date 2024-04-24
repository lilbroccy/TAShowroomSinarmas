@extends('layout-admin.index')
@section('title', "Car Unit")
@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Car Unit</h3>
                <div class="d-flex align-carUnits-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Car Unit</li>
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
                            <div class="col-md-6"><h4 class="card-title">Tabel Car Unit</h4></div>
                            <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary float-end" id="tambahUnitMobil"><i class="fas fa-plus"></i>Tambah Unit Mobil</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="carunits" class="table no-wrap">
                                <thead>
                                    <tr>
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
                                    <th>Deskripsi</th>
                                    <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($carUnits as $carUnit)
                            <tr>
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
                                        <td class="text-right">
                                            <!-- Tombol Update -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal{{ $carUnit->id }}" title="Edit Data Mobil">
                                                <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                                            </button>

                                            <!-- Tombol Delete -->
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $carUnit->id }}" title="Hapus Data Mobil">
                                                <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus -->
                                            </button>
                                            <a href="{{url('admin/dashboard/car-units/'.$carUnit->id.'/upload')}}" class="btn btn-info" title="Tambah/Lihat Foto Mobil">
                                                <i class="fas fa-camera"></i> <!-- Ganti dengan ikon yang sesuai -->
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Unit Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahModalForm">
                @csrf
                <div class="form-group">
                        <label for="name">Nama Mobil:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <!-- Form group untuk Brand -->
                    <div class="form-group">
                        <label for="brand_id">Brand:</label>
                        <select class="form-control" id="brand_id" name="brand_id" required>
                            <!-- Opsi brand akan diisi melalui AJAX -->
                        </select>
                    </div>
                    <!-- Form group untuk Kategori -->
                    <div class="form-group">
                        <label for="category_id">Kategori:</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <!-- Opsi kategori akan diisi melalui AJAX -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga:</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="year">Tahun:</label>
                        <input type="text" class="form-control" id="year" name="year">
                    </div>
                    <div class="form-group">
                        <label for="fuel_type">Tipe Bahan Bakar:</label>
                        <input type="text" class="form-control" id="fuel_type" name="fuel_type">
                    </div>
                    <div class="form-group">
                        <label for="seat">Jumlah Kursi:</label>
                        <input type="text" class="form-control" id="seat" name="seat">
                    </div>
                    <div class="form-group">
                        <label for="warranty">Garansi:</label>
                        <input type="text" class="form-control" id="warranty" name="warranty">
                    </div>
                    <div class="form-group">
                        <label for="color">Warna:</label>
                        <input type="text" class="form-control" id="color" name="color">
                    </div>
                    <div class="form-group">
                        <label for="mileage">Jarak Tempuh:</label>
                        <input type="text" class="form-control" id="mileage" name="mileage">
                    </div>
                    <div class="form-group">
                        <label for="engine_cc">CC Mesin:</label>
                        <input type="text" class="form-control" id="engine_cc" name="engine_cc">
                    </div>
                    <div class="form-group">
                        <label for="service_book">Buku Service:</label>
                        <input type="text" class="form-control" id="service_book" name="service_book">
                    </div>
                    <div class="form-group">
                        <label for="spare_key">Kunci Cadangan:</label>
                        <input type="text" class="form-control" id="spare_key" name="spare_key">
                    </div>
                    <div class="form-group">
                        <label for="unit_document">Dokumen Unit:</label>
                        <input type="text" class="form-control" id="unit_document" name="unit_document">
                    </div>
                    <div class="form-group">
                        <label for="stnk_validity_period">Masa Berlaku STNK:</label>
                        <input type="text" class="form-control" id="stnk_validity_period" name="stnk_validity_period">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-end" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary float-end ms-2" id="simpanButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                            <!-- <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Unit Mobil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="tambahModalForm">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama">Nama Mobil:</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                                </div>

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Modal Update -->
                            @foreach ($carUnits as $carUnit)
                            <div class="modal fade" id="updateModal{{ $carUnit->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $carUnit->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $carUnit->id }}">Update Car</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulir Update Karyawan -->
                                            <form action="" method="post">
                                                @csrf
                                                @method('PUT') <!-- Menggunakan metode PUT untuk update -->

                                                <div class="form-group">
                                                    <label for="namaUpdate">Nama:</label>
                                                    <input type="text" class="form-control" id="namaUpdate" name="namaUpdate" value="{{ $carUnit->name }}" required>
                                                </div>
                                                <!-- Tambahkan kolom formulir lain sesuai kebutuhan -->

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Modal Delete -->
                            @foreach ($carUnits as $carUnit)
                            <div class="modal fade" id="deleteModal{{ $carUnit->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $carUnit->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $carUnit->id }}">Konfirmasi Hapus carUnits</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus carUnits {{ $carUnit->name }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#carunits').DataTable( {
        scrollY:        3000,
        scrollX:        true,
        scrollCollapse: true,
        fixedColumns:   {
            leftColumns: 1,  // Jumlah kolom kiri yang tetap
            rightColumns: 1  // Jumlah kolom kanan yang tetap
        }
    } );
    })
</script>
<script src="{{ asset('admin/modal/car-units.js') }}"></script>
@endsection

