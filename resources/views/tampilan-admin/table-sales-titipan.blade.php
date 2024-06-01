@extends('layout-admin.index')
@section('title', "Car Unit")
@section('body')
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tabel Penjualan Mobil Titipan</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4 class="card-title">Tabel Penjualan Mobil Titipan</h4></div>
                            <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary float-end" id="tambahPenjualan"  data-bs-toggle="modal" data-bs-target="#modalMobil"><i class="fas fa-plus"></i> Tambah Data Penjualan</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="sales" class="table no-wrap">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama Mobil</th>
                                    <th>Harga Mobil</th>
                                    <th>Fee Penitipan</th>
                                    <th>Sistem Pembayaran</th>
                                    <th>Tanggal Transaksi</th>
                                    <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $no=1
                                @endphp
                                @foreach ($sales as $sale)
                            <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $sale->carUnit->name }}</td>
                            <td>{{ $sale->carUnit->price }}</td>
                            <td>{{ $sale->carUnit->fee }}</td>
                            <td>{{ $sale->payment_method }}</td>
                            <td>{{ $sale->date }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $sale->id }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <!-- <button class="btn btn-danger btn-sm deleteBtn" data-saleid="{{ $sale->id }}" data-salename="{{ $sale->name }}" title="Hapus sale">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button> -->
                                </td>
                            </tr>
                            
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach($sales as $sale)
                            <div class="modal fade" id="detailModal{{ $sale->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $sale->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $sale->id }}">Detail Penjualan Titipan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <!-- Pemilik -->
                                                <div class="col-6">
                                                <h6 class="modal-subtitle"><u>Informasi Penitip</u></h6>
                                                    <p><strong>Nama Penitip:</strong> {{ $sale->carUnit->user->name }}</p>
                                                    <p><strong>No. HP/WA:</strong> {{ $sale->carUnit->user->phone }}</p>
                                                    <p><strong>Alamat:</strong> {{ $sale->carUnit->user->address }}</p>
                                                </div>
                                                <!-- Pembeli -->
                                                <div class="col-6">
                                                <h6 class="modal-subtitle"><u>Informasi Pembeli</u></h6>
                                                    <p><strong>Nama Pembeli:</strong> 
                                                        @if ($sale->user)
                                                            {{ $sale->user->name }}
                                                        @else
                                                            {{ $sale->customer_name }}
                                                        @endif
                                                    </p>
                                                    <p><strong>No. HP/WA:</strong> 
                                                        @if ($sale->user)
                                                            {{ $sale->user->phone }}
                                                        @else
                                                            {{ $sale->customer_phone }}
                                                        @endif
                                                    </p>
                                                    <p><strong>Alamat:</strong> 
                                                        @if ($sale->user)
                                                            {{ $sale->user->address }}
                                                        @else
                                                            {{ $sale->customer_addres }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Data Penjualan -->
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                <h6 class="modal-subtitle"><u>Informasi Penjualan</u></h6>
                                                    <p><strong>Nama Mobil:</strong> {{ $sale->carUnit->name }}</p>
                                                    <p><strong>Harga Mobil:</strong> Rp {{ number_format($sale->carUnit->price, 0, ',', '.') }}</p>
                                                    <p><strong>Fee Penitipan:</strong> Rp {{ number_format($sale->carUnit->fee, 0, ',', '.') }}</p>
                                                    <p><strong>Sistem Pembayaran:</strong> {{ $sale->payment_method }}</p>
                                                    <p><strong>Tanggal Transaksi:</strong> {{ $sale->date }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="modal fade" id="modalMobil" tabindex="-1" aria-labelledby="modalMobilLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalMobilLabel">Data Mobil Tersedia</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Cari Unit Mobil..." aria-label="Cari" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                            <div class="row">
                                            @foreach($carUnits as $carUnit)
                                                @if($carUnit->status === 'Tersedia')
                                                    <div class="col-md-4 mb-2">
                                                        <div class="card border" style="border-radius: 15px; border-width: 10px;" onmouseover="this.classList.add('shadow-sm'); this.classList.add('bg-light')" onmouseout="this.classList.remove('shadow-sm'); this.classList.remove('bg-light')">
                                                            @foreach ($carUnit->photos->take(1) as $photo)
                                                                <a href="#" class="car-sale-link" data-id="{{ $carUnit->id }}" data-name="{{ $carUnit->name }}">
                                                                    <img src="{{ asset('storage/'.$photo->file_path) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px 10px 0 0;" alt="...">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">
                                                                            <a href="#" class="car-sale-link" data-id="{{ $carUnit->id }}" data-name="{{ $carUnit->name }}" style="text-decoration: none; color: inherit; transition: color 0.3s;" onmouseover="this.style.color='#007bff'" onmouseout="this.style.color='#000'">{{ $carUnit->name }}</a>
                                                                        </h5>
                                                                        <p class="text-muted fw-normal"> {{$carUnit->brand->name}} - {{$carUnit->year}} - {{$carUnit->transmission}} - {{$carUnit->fuel_type}}</p>
                                                                        <p style="color:black"><b>Rp. {{ number_format($carUnit->price, 0, ',', '.') }}</b></p>
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif        
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="formPembeliModal" tabindex="-1" aria-labelledby="formPembeliModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formPembeliModalLabel">Form Pembeli - <span id="carName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPembeliData">
                @csrf
                    <input type="hidden" id="carId" name="car_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment" class="form-label">Sistem Pembayaran:</label>
                        <select class="form-select" id="payment" name="payment" required>
                            <option value="" selected disabled>Pilih sistem pembayaran</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Kredit">Kredit</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

                            <!-- Modal Update -->
                            @foreach ($sales as $sale)
                            <div class="modal fade" id="updateModal{{ $sale->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $sale->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $sale->id }}">Update Penjualan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="updateForm_{{ $sale->id }}" class="updateForm">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Nama sale:</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $sale->name }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary updateButton" id="updateButton_{{ $sale->id }}">Simpan Perubahan</button>
                                                </div>
                                            </form>
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
                                            Apakah Anda yakin ingin menghapus sale?
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
        $('#sales').DataTable( {
        scrollY:        3000,
        scrollX:        true,
        scrollCollapse: true,
        fixedColumns:   {
            leftColumns: 1, 
            rightColumns: 1 
        }
    } );
    })
</script>
<script>
    $(document).ready(function(){
    $('.car-sale-link').off('click').on('click', function(e) {
        e.preventDefault();
        var carName = $(this).data('name');
        var carId = $(this).data('id');
        $('#carName').text(carName);
        $('#carId').val(carId);
        Swal.fire({
            title: 'Apakah mobil ' + carName + ' terjual?',
            showDenyButton: true,
            confirmButtonText: `Ya`,
            denyButtonText: `Tidak`,
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formPembeliModal').modal('show');
            } else if (result.isDenied) {
                Swal.fire('Dibatalkan', '', 'info');
            }
        });
    });

    $('#formPembeliData').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '{{ route("sales.store") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire('Pembeli berhasil ditambahkan!', '', 'success');
                $('#formPembeliModal').modal('hide');
            },
            error: function(error) {
                Swal.fire('Gagal menyimpan data pembeli', '', 'error');
            }
        });
    });
});
</script>
@endsection

