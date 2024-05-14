@extends('layout-admin.index')
@section('title', "Car Unit")
@section('body')
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tabel Penjualan</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4 class="card-title">Tabel Penjualan</h4></div>
                        </div>
                        <div class="table-responsive">
                            <table id="sales" class="table no-wrap">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama Mobil</th>
                                    <th>Harga Mobil</th>
                                    <th>Nama Pembeli</th>
                                    <th>No HP</th>
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
                            <td>{{ $sale->user->name }}</td>
                            <td>{{ $sale->user->phone }}</td>
                            <td>{{ $sale->payment_method }}</td>
                            <td>{{ $sale->date }}</td>
                                <td class="text-right">
                                    <!-- Tombol Update -->
                                    <button class="btn btn-warning btn-sm updateBtn" data-saleid="{{ $sale->id }}" data-salename="{{ $sale->name }}" title="Edit sale">
                                        <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                                    </button>
                                    <!-- Tombol Delete -->
                                    <button class="btn btn-danger btn-sm deleteBtn" data-saleid="{{ $sale->id }}" data-salename="{{ $sale->name }}" title="Hapus sale">
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
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah sale Mobil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tambahModalForm">
                                            @csrf
                                            <div class="form-group">
                                                    <label for="name">Nama sale:</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <!-- Form group untuk sale -->
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
                            @foreach ($sales as $sale)
                            <div class="modal fade" id="updateModal{{ $sale->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $sale->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $sale->id }}">Update Kategori {{ $sale->name }}</h5>
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
<script src="{{ asset('admin/modal/sales.js') }}"></script>
@endsection

