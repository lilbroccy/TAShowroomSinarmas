@extends('layout-admin.index')
@section('title', "Car Unit")
@section('body')
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Brand</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4 class="card-title">Tabel Brand</h4></div>
                            <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary float-end" id="tambahBrand"><i class="fas fa-plus"></i> Tambah Brand</button>
                            </div>
                        </div>
                        <div class="table-responsive">
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
                                    <button class="btn btn-warning btn-sm updateBtn" data-brandid="{{ $brand->id }}" data-brandname="{{ $brand->name }}" title="Edit Brand">
                                        <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                                    </button>
                                    <!-- Tombol Delete -->
                                    <button class="btn btn-danger btn-sm deleteBtn" data-brandid="{{ $brand->id }}" data-brandname="{{ $brand->name }}" title="Hapus Brand">
                                        <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus -->
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
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Brand Mobil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tambahModalForm">
                                            @csrf
                                            <div class="form-group">
                                                    <label for="name">Nama Brand:</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <!-- Form group untuk Brand -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary float-end" data-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-primary float-end ms-2" id="simpanButton">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Update -->
                            @foreach ($brands as $brand)
                            <div class="modal fade" id="updateModal{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $brand->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $brand->id }}">Update Kategori {{ $brand->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="updateForm_{{ $brand->id }}" class="updateForm">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Nama Brand:</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary updateButton" id="updateButton_{{ $brand->id }}">Simpan Perubahan</button>
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
                                            Apakah Anda yakin ingin menghapus brand?
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
        $('#brands').DataTable( {
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
<script src="{{ asset('admin/modal/brands.js') }}"></script>
@endsection

