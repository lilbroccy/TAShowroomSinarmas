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
                                    <button class="btn btn-primary float-end" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus"></i> Tambah Unit Mobil</button>
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
                                            <form action="" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama">Nama carUnits:</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                                </div>
                                                <!-- Tambahkan kolom formulir lain sesuai kebutuhan -->

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection

