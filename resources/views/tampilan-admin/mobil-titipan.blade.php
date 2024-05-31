@extends('layout-admin.index')
@section('title', "Car Unit")
@section('css')
<style>
    .position-relative {
        display: flex; /* Menggunakan flexbox */
        flex-wrap: wrap; /* Mengizinkan gambar untuk berada dalam beberapa baris */
        justify-content: center; /* Menyatukan gambar di tengah */
    }

    .img-thumbnail {
        margin-right: 10px;
        margin-bottom: 10px; /* Memberikan margin bawah pada setiap gambar */
        width: 200px;
        height: 150px; /* Sesuaikan tinggi gambar sesuai kebutuhan Anda */
        object-fit: cover; /* Gambar akan diperbesar/diperkecil agar terisi penuh dalam kotak */
        transition: transform 0.3s;
    }

    .img-thumbnail:hover {
        transform: scale(1.1);
    }
    
    .mfp-bg {
        z-index: 1060;
    }
    .mfp-wrap {
        z-index: 1060;
    }

</style>

@endsection
@section('body')
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Titipan</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4 class="card-title">Tabel Data Mobil Titipan</h4></div>
                            <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary float-end" id="tambahUnitMobil"><i class="fas fa-plus"></i>Tambah Unit Mobil</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="titipan" class="table no-wrap">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama Penitip</th>
                                    <th>Nama Mobil</th>
                                    <th>Brand</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Status Penitipan</th>
                                    <th>Status Unit</th>
                                    <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $no=1
                                @endphp
                                @foreach ($carUnits as $carUnit)
                                <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $carUnit->user->name }}</td>
                                <td>{{ $carUnit->name }}</td>
                                <td>{{ $carUnit->brand->name }}</td>
                                <td>{{ $carUnit->category->name }}</td>
                                <td>Rp. {{ number_format($carUnit->price, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if($carUnit->type_status == 'Menunggu Verifikasi')
                                        <span style="background-color: #888888; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                            {{ $carUnit->type_status }}
                                        </span>
                                    @elseif($carUnit->type_status == 'Disetujui')
                                        <span style="background-color: #34D399; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                            {{ $carUnit->type_status }}
                                        </span>
                                    @elseif($carUnit->type_status == 'Ditolak')
                                    <span style="background-color: #ff0000; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                        {{ $carUnit->type_status }}
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($carUnit->status == 'Tersedia')
                                        <span style="background-color: #34D399; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                            {{ $carUnit->status }}
                                        </span>
                                    @elseif($carUnit->status == 'Terjual' | $carUnit->status == 'Ditolak')
                                    <span style="background-color: #ff0000; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                        {{ $carUnit->status }}
                                    </span>
                                    @elseif($carUnit->status == 'Menunggu Verifikasi')
                                    <span style="background-color: #888888; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                        {{ $carUnit->status }}
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $carUnit->id }}" title="Detail Data Mobil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm optionBtn" data-carunitid="{{ $carUnit->id }}" data-carunitname="{{ $carUnit->name }}" title="Opsi">
                                        <i class="fas fa-cogs"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm deleteBtn" data-carunitid="{{ $carUnit->id }}" data-carunitname="{{ $carUnit->name }}" title="Hapus Data Mobil">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Unit Mobil Titipan</h5>
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
                                                    <input type="text" class="form-control" id="price" name="price" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="year">Tahun:</label>
                                                    <input type="text" class="form-control" id="year" name="year" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fuel_type">Tipe Bahan Bakar:</label>
                                                    <select class="form-control" id="fuel_type" name="fuel_type" required>
                                                        <option value="" disabled selected>-- Pilih Opsi --</option>
                                                        @foreach(\App\Models\CarUnit::FUEL_TYPE_OPTIONS as $option)
                                                            <option value="{{ $option }}">{{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="transmission">Transmisi:</label>
                                                    <select class="form-control" id="transmission" name="transmission" required>
                                                        <option value="" disabled selected>-- Pilih Opsi --</option>
                                                        @foreach(\App\Models\CarUnit::TRANSMISSION_OPTIONS as $option)
                                                            <option value="{{ $option }}">{{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="seat">Jumlah Kursi:</label>
                                                    <input type="text" class="form-control" id="seat" name="seat" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="warranty">Garansi:</label>
                                                    <input type="text" class="form-control" id="warranty" name="warranty" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Warna:</label>
                                                    <input type="text" class="form-control" id="color" name="color" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mileage">Jarak Tempuh:</label>
                                                    <input type="text" class="form-control" id="mileage" name="mileage" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="engine_cc">CC Mesin:</label>
                                                    <input type="text" class="form-control" id="engine_cc" name="engine_cc" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="service_book">Buku Service:</label>
                                                    <select class="form-control" id="service_book" name="service_book" required>
                                                        <option disabled selected>--Pilih Opsi--</option>
                                                        <option value="1">Ya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="spare_key">Kunci Cadangan:</label>
                                                    <select class="form-control" id="spare_key" name="spare_key" required>
                                                        <option disabled selected>--Pilih Opsi--</option>
                                                        <option value="1">Ya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="unit_document">Dokumen Unit:</label>
                                                    <select class="form-control" id="unit_document" name="unit_document" required>
                                                        <option disabled selected>--Pilih Opsi--</option>
                                                        <option value="1">Ya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="stnk_validity_period">Masa Berlaku STNK:</label>
                                                    <input type="text" class="form-control" id="stnk_validity_period" name="stnk_validity_period" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Deskripsi:</label>
                                                    <textarea class="form-control" id="description" name="description" required></textarea>
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

                            <!-- Modal Detail -->
                            @foreach ($carUnits as $carUnit)
    <div class="modal fade" id="detailModal{{ $carUnit->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $carUnit->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $carUnit->id }}">Detail Mobil {{ $carUnit->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom pertama -->
                        <div class="col-md-6">
                            @foreach ([
                                'Nama Penitip' => $carUnit->user->name,
                                'Nomor HP/WA Penitip' => $carUnit->user->phone,
                                'Nama' => $carUnit->name,
                                'Brand' => $brands->firstWhere('id', $carUnit->brand_id)->name,
                                'Kategori' => $categories->firstWhere('id', $carUnit->category_id)->name,
                                'Harga' => 'Rp. ' . number_format($carUnit->price, 0, ',', '.'),
                                'Tahun' => $carUnit->year,
                                'Tipe Bahan Bakar' => $carUnit->fuel_type,
                                'Transmisi' => $carUnit->transmission,
                                'Jumlah Kursi' => $carUnit->seat
                            ] as $label => $value)
                                <div class="mb-3">
                                    <strong>{{ $label }}:</strong>
                                    <p class="border-bottom">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                        <!-- Kolom kedua -->
                        <div class="col-md-6">
                            @foreach ([
                                'Garansi' => $carUnit->warranty,
                                'Warna' => $carUnit->color,
                                'Jarak Tempuh' => $carUnit->mileage . ' km',
                                'CC Mesin' => $carUnit->engine_cc . ' cc',
                                'Buku Service' => $carUnit->service_book ? 'Ya' : 'Tidak',
                                'Kunci Cadangan' => $carUnit->spare_key ? 'Ya' : 'Tidak',
                                'Dokumen Unit' => $carUnit->unit_document ? 'Ya' : 'Tidak',
                                'Masa Berlaku STNK' => $carUnit->stnk_validity_period
                            ] as $label => $value)
                                <div class="mb-3">
                                    <strong>{{ $label }}:</strong>
                                    <p class="border-bottom">{{ $value }}</p>
                                </div>
                            @endforeach
                            <div class="mb-3">
                                <strong>Deskripsi:</strong>
                                <textarea class="form-control" rows="4" readonly>{{ $carUnit->description }}</textarea>
                            </div>
                        </div>
                        <!-- Foto -->
                        <div class="col-md-12">
                            <strong>Foto:</strong>
                            <div class="d-flex flex-wrap gap-2 mt-2 magnific-gallery">
                                @foreach($carUnit->photos as $photo)
                                    <a href="{{ asset('storage/'.$photo->file_path) }}" class="image-link">
                                        <img src="{{ asset('storage/'.$photo->file_path) }}" alt="Foto Mobil" class="img-thumbnail" style="width: 200px;">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

                            <div class="modal fade" id="userProfileModal{{ $carUnit->user->id }}" role="dialog" tabindex="-1" aria-labelledby="userProfileModalLabel{{ optional($carUnit->user)->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="userProfileModalLabel{{ optional($carUnit->user)->id }}">Profil Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <p style="color: black;"><b>Nama: </b>{{ optional($carUnit->user)->name ?? 'Guest' }}</p>
                                        <p style="color: black;"><b>Nomor Telepon: </b>
                                            <span style="background-color: #00d885; color: white; padding: 4px 8px; border-radius: 10px; font-weight: bold;">
                                                {{ optional($carUnit->user)->phone ?? '-' }}
                                                <i class="fa fa-whatsapp" style="margin-left: 5px;"></i>
                                            </span>
                                        </p>
                                        <p style="color: black;"><b>Email: </b>
                                            <span style="background-color: #448fff; color: white; padding: 4px 8px; border-radius: 10px; font-weight: bold;">
                                                {{ optional($carUnit->user)->email ?? '-' }}
                                            </span>
                                        </p>
                                        <p style="color: black;"><b>Alamat: </b>{{ $carUnit->user->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="deleteModalBody">
                                            Apakah Anda yakin ingin menghapus data mobil?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function(){
        $('#titipan').DataTable( {
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
<script>
    $(document).ready(function() {
    $('.user').click(function() {
        var userId = $(this).data('id');
        $('[id^="detailModal"]').modal('hide');
        $('#userProfileModal' + userId).modal('show');
    });
    $('.whatsapp-link').click(function(e) {
        e.preventDefault();
        var phoneNumber = $(this).data('phone');
        phoneNumber = phoneNumber.replace(/^0/, '62');
        var url = 'https://wa.me/' + phoneNumber;
        window.open(url, '_blank');
    });

    $('.optionBtn').click(function() {
        var carUnitId = $(this).data('carunitid');
        var carUnitName = $(this).data('carunitname');
        Swal.fire({
            title: 'Silahkan pilih opsi untuk permintaan penitipan ini',
            icon: 'info',
            showCancelButton: true,
            showCloseButton: true, // Menampilkan tombol close
            confirmButtonText: 'Setujui',
            cancelButtonText: 'Tolak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/ubah-status-car-unit",
                    data: {
                        carUnitId: carUnitId,
                        status: 'Tersedia',
                        type_status: 'Disetujui',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Permintaan disetujui!',
                            icon: 'success',
                            showCloseButton: true
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Terjadi kesalahan', 'Gagal memproses permintaan.', 'error');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                $.ajax({
                    type: "POST",
                    url: "/ubah-status-car-unit",
                    data: {
                        carUnitId: carUnitId,
                        status: 'Ditolak',
                        type_status: 'Ditolak',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Permintaan penitipan ditolak!',
                            icon: 'error',
                            showCloseButton: true
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Terjadi kesalahan', 'Gagal memproses permintaan.', 'error');
                    }
                });
            }
        });
    });
});
</script>
<!-- <script src="{{ asset('admin/modal/car-units.js') }}"></script> -->
<script>
    $(document).ready(function() {
        $('.magnific-gallery').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    });
</script>
@endsection

