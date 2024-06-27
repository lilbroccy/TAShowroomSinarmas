@extends('layout-admin.index')
@section('title', "Car Unit")
@section('body')
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Mobil</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4 class="card-title">Tabel Data Mobil</h4></div>
                            <div class="col-md-6 text-right">
                                <div class="btn-group float-end" role="group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                       Tabel
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-table="unit">Unit</a></li>
                                        <li><a class="dropdown-item" href="#" data-table="categories">Kategori</a></li>
                                        <li><a class="dropdown-item" href="#" data-table="brand">Brand</a></li>
                                    </ul>
                                    <button type="button" class="btn btn-primary ms-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Tambah Data
                                    </button>
                                    <ul class="dropdown-menu">
    <li>
        <button type="button" class="dropdown-item" id="tambahUnitMobil" data-action="tambahUnit">
            <i class="fas fa-plus"></i> Tambah Unit Mobil
        </button>
    </li>
    <li>
        <button type="button" class="dropdown-item" id="tambahKategori" data-action="tambahKategori">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </li>
    <li>
        <button type="button" class="dropdown-item" id="tambahBrand" data-action="tambahBrand">
            <i class="fas fa-plus"></i> Tambah Brand
        </button>
    </li>
</ul>

                                    
                                </div>
                            </div>
                        </div>
                        <div id="unitTable" class="table-responsive">
                            <table id="carunits" class="table no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Brand</th>
                                        <th>Kategori</th>
                                        <th>Tahun</th>
                                        <th>Bahan Bakar</th>
                                        <th>Transmisi</th>
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
                                        <th>Status</th>
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
                                        <td>{{ $carUnit->name }}</td>
                                        <td>Rp. {{ number_format($carUnit->price, 0, ',', '.') }}</td>
                                        <td>{{ $carUnit->brand->name }}</td>
                                        <td>{{ $carUnit->category->name }}</td>
                                        <td>{{ $carUnit->year }}</td>
                                        <td>{{ $carUnit->fuel_type }}</td>
                                        <td>{{ $carUnit->transmission }}</td>
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
                                        <td style="text-align: center;">
                                            @if($carUnit->status == 'Tersedia')
                                                <span style="background-color: #34D399; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                                    {{ $carUnit->status }}
                                                </span>
                                            @elseif($carUnit->status == 'Terjual')
                                                <span style="background-color: #FF5F5F; color: #ffffff; border-radius: 0.5rem; padding: 0.25rem 0.5rem; font-weight: bold; font-size: 0.75rem;">
                                                    {{ $carUnit->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm updateBtnCar" data-carunitid="{{ $carUnit->id }}" data-carunitname="{{ $carUnit->name }}" title="Edit Data Mobil">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm deleteBtnCar" data-carunitid="{{ $carUnit->id }}" data-carunitname="{{ $carUnit->name }}" title="Hapus Data Mobil">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <a href="{{url('admin/dashboard/car-units/'.$carUnit->id.'/upload')}}" class="btn btn-info" title="Tambah/Lihat Foto Mobil">
                                                <i class="fas fa-camera"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tambah Modal -->
                            <div class="modal fade" id="tambahModalUnit" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Unit Mobil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tambahModalUnitForm">
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
                                                    <button type="button" class="btn btn-primary float-end ms-2" id="simpanButtonUnit">Simpan</button>
                                                </div>
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
                                            <h5 class="modal-title" id="updateModalLabel{{ $carUnit->id }}">Update Car {{ $carUnit->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="updateForm_{{ $carUnit->id }}" class="updateForm">
                                            @csrf
                                            @method('PUT')
                                            <!-- Tambahkan ID unik untuk setiap elemen formulir -->
                                                <div class="form-group">
                                                    <label for="name">Nama:</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $carUnit->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="brand_id">Brand:</label>
                                                    <select class="form-control" id="brand_id" name="brand_id" required>
                                                        <!-- Opsi brand akan diisi melalui AJAX -->
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}" {{ $brand->id == $carUnit->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <!-- Form group untuk Kategori -->
                                                <div class="form-group">
                                                    <label for="category_id">Kategori:</label>
                                                    <select class="form-control" id="category_id" name="category_id" required>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $category->id == $carUnit->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Harga:</label>
                                                    <input type="text" class="form-control" id="price" name="price" value="{{ $carUnit->price }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="year">Tahun:</label>
                                                    <input type="text" class="form-control" id="year" name="year" value="{{ $carUnit->year }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fuel_type">Tipe Bahan Bakar:</label>
                                                    <select class="form-control" id="fuel_type" name="fuel_type" required>
                                                        @foreach(\App\Models\CarUnit::FUEL_TYPE_OPTIONS as $option)
                                                            <option value="{{ $option }}" @if($carUnit->fuel_type == $option) selected @endif>{{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="transmission">Transmisi:</label>
                                                    <select class="form-control" id="transmission" name="transmission" required>
                                                        @foreach(\App\Models\CarUnit::TRANSMISSION_OPTIONS as $option)
                                                            <option value="{{ $option }}" @if($carUnit->transmission == $option) selected @endif>{{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="seat">Jumlah Kursi:</label>
                                                    <input type="text" class="form-control" id="seat" name="seat" value="{{ $carUnit->seat }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="warranty">Garansi:</label>
                                                    <input type="text" class="form-control" id="warranty" name="warranty" value="{{ $carUnit->warranty }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Warna:</label>
                                                    <input type="text" class="form-control" id="color" name="color" value="{{ $carUnit->color }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mileage">Jarak Tempuh:</label>
                                                    <input type="text" class="form-control" id="mileage" name="mileage" value="{{ $carUnit->mileage }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="engine_cc">CC Mesin:</label>
                                                    <input type="text" class="form-control" id="engine_cc" name="engine_cc" value="{{ $carUnit->engine_cc }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="service_book">Buku Service:</label>
                                                    <select class="form-control" id="service_book" name="service_book" required>
                                                        <option value="1" @if ($carUnit->service_book === 1) selected @endif>Ya</option>
                                                        <option value="0" @if ($carUnit->service_book === 0) selected @endif>Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="spare_key">Kunci Cadangan:</label>
                                                    <select class="form-control" id="spare_key" name="spare_key" required>
                                                        <option value="1" @if ($carUnit->spare_key === 1) selected @endif>Ya</option>
                                                        <option value="0" @if ($carUnit->spare_key === 0) selected @endif>Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="unit_document">Dokumen Unit:</label>
                                                    <select class="form-control" id="unit_document" name="unit_document" required>
                                                        <option value="1" @if ($carUnit->unit_document === 1) selected @endif>Ya</option>
                                                        <option value="0" @if ($carUnit->unit_document === 0) selected @endif>Tidak</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="stnk_validity_period">Masa Berlaku STNK:</label>
                                                    <input type="text" class="form-control" id="stnk_validity_period" name="stnk_validity_period" value="{{ $carUnit->stnk_validity_period }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Deskripsi:</label>
                                                    <textarea class="form-control" id="description" name="description" required>{{ $carUnit->description }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary updateButton" id="updateButton_{{ $carUnit->id }}">Simpan Perubahan</button>
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
                        <div id="categoryTable" class="table-responsive" style="display: none;">
                            <table id="categories" class="table no-wrap">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama</th>                        
                                    <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $no=1
                                @endphp
                                @foreach ($categories as $category)
                            <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $category->name }}</td>
                                <td class="text-right">
                                    <!-- Tombol Update -->
                                    <button class="btn btn-warning btn-sm updateBtnCate" data-categoryid="{{ $category->id }}" data-categoryname="{{ $category->name }}" title="Edit Data Kategori">
                                        <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                                    </button>
                                    <!-- Tombol Delete -->
                                    <button class="btn btn-danger btn-sm deleteBtnCate" data-categoryid="{{ $category->id }}" data-categoryname="{{ $category->name }}" title="Hapus Data Kategori">
                                        <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus -->
                                    </button>
                                </td>
                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tambah Modal -->
                            <div class="modal fade" id="tambahModalKategori" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Kategori Mobil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tambahModalKategoriForm">
                                            @csrf
                                            <div class="form-group">
                                                    <label for="name">Nama Kategori:</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <!-- Form group untuk Brand -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary float-end" data-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-primary float-end ms-2" id="simpanButtonKategori">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Update -->
                            @foreach ($categories as $category)
                            <div class="modal fade" id="updateModalCate{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $category->id }}">Update Kategori {{ $category->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="updateFormCate_{{ $category->id }}" class="updateForm">
                                            @csrf
                                            @method('PUT')
                                            <!-- Tambahkan ID unik untuk setiap elemen formulir -->
                                                <div class="form-group">
                                                    <label for="name">Nama Kategori:</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary updateButtonCate" id="updateButtonCate_{{ $category->id }}">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="modal fade" id="deleteModalCate" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="deleteModalBodyCate">
                                            Apakah Anda yakin ingin menghapus kategori?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger" id="confirmDeleteCate">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="brandTable" class="table-responsive" style="display: none;">
                            <table id="brands" class="table no-wrap">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama</th>                        
                                    <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $no=1
                                @endphp
                                @foreach ($brands as $brand)
                            <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $brand->name }}</td>
                                <td class="text-right">
                                    <!-- Tombol Update -->
                                    <button class="btn btn-warning btn-sm updateBtnBrand" data-brandid="{{ $brand->id }}" data-brandname="{{ $brand->name }}" title="Edit Brand">
                                        <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                                    </button>
                                    <!-- Tombol Delete -->
                                    <button class="btn btn-danger btn-sm deleteBtnBrand" data-brandid="{{ $brand->id }}" data-brandname="{{ $brand->name }}" title="Hapus Brand">
                                        <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus -->
                                    </button>
                                </td>
                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tambah Modal -->
                            <div class="modal fade" id="tambahModalBrand" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Brand Mobil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tambahModalBrandForm">
                                            @csrf
                                            <div class="form-group">
                                                    <label for="name">Nama Brand:</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <!-- Form group untuk Brand -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary float-end" data-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-primary float-end ms-2" id="simpanButtonBrand">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Update -->
                            @foreach ($brands as $brand)
                            <div class="modal fade" id="updateModalBrand{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $brand->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $brand->id }}">Update Kategori {{ $brand->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="updateFormBrand_{{ $brand->id }}" class="updateForm">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Nama Brand:</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary updateButtonBrand" id="updateButtonBrand_{{ $brand->id }}">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="modal fade" id="deleteModalBrand" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="deleteModalBody">
                                            Apakah Anda yakin ingin menghapus brand?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger" id="confirmDeleteBrand">Hapus</button>
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
$(document).ready(function() {
    $('#carunits').DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: {
            leftColumns: 1,
            rightColumns: 1
        }
    });

    $('#categories').DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: {
            leftColumns: 1,
            rightColumns: 1
        }
    });

    $('#brands').DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: {
            leftColumns: 1,
            rightColumns: 1
        }
    });

    $('.dropdown-item').click(function() {
        var table = $(this).data('table');
        $('#unitTable').hide();
        $('#categoryTable').hide();
        $('#brandTable').hide();

        if (table === 'unit') {
            $('#unitTable').show();
        } else if (table === 'categories') {
            $('#categoryTable').show();
        } else if (table === 'brand') {
            $('#brandTable').show();
        }

    
    var action = $(this).data('action'); // Mengambil ID dari tombol yang diklik
    
    if (action === 'tambahUnitMobil') {
        $('#tambahModalUnit').modal('show');
    } else if (action === 'tambahKategori') {
        $('#tambahModalKategori').modal('show');
    } else if (action === 'tambahBrand') {
        $('#tambahModalBrand').modal('show');
    }

        
    });
});
</script>
<script src="{{ asset('admin/modal/car-units.js') }}"></script>
<script src="{{ asset('admin/modal/categories.js') }}"></script>
<script src="{{ asset('admin/modal/brands.js') }}"></script>
@endsection

