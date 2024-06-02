@extends('layout-admin.index')
@section('title', "Data User")
@section('body')
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><h4 class="card-title">Tabel User</h4></div>
                            <!-- <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary float-end" id="tambahAdmin"><i class="fas fa-plus"></i> Tambah Admin</button>
                            </div> -->
                        </div>
                        <div class="table-responsive">
                            <table id="users" class="table no-wrap">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP/WA</th>
                                    <th>Alamat</th>
                                    <th>Role</th>           
                                    <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $no=1
                                @endphp
                                @foreach ($users as $user)
                            <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->role }}</td>
                                <td class="text-right">
                                    <button class="btn btn-danger btn-sm deleteBtn" 
                                            data-userid="{{ $user->id }}" 
                                            data-username="{{ $user->name }}" 
                                            title="Hapus Data Pengguna">
                                        <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus -->
                                    </button>
                                </td>
                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tambah Modal -->
                            <!-- <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Admin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tambahModalForm">
                                            @csrf
                                            <div class="form-group">
                                                    <label for="name">Nama Admin:</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Nomor HP/WA:</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="text" class="form-control" id="email" name="email" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary float-end" data-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-primary float-end ms-2" id="simpanButton">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- Modal Update -->
                            @foreach ($users as $user)
                            <div class="modal fade" id="updateModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $user->id }}">Update User {{ $user->name }}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="updateForm_{{ $user->id }}" class="updateForm">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Nama User:</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Email:</label>
                                                    <input type="text" class="form-control" id="name" name="email" value="{{ $user->email }}" required readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Nomor HP/WA:</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Peran:</label>
                                                    <select class="form-control" id="role" name="role" required>
                                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary updateButton" id="updateButton_{{ $user->id }}">Simpan Perubahan</button>
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
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="deleteModalBody">
                                            Apakah Anda yakin ingin menghapus User?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
        $('#users').DataTable( {
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
<script src="{{ asset('admin/modal/users.js') }}"></script>
@endsection

