@extends('layout-admin.index')
@section('title', "Car Unit Photos")
@section('css')
<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 10px;
    }

    .car-title {
        text-align: center;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .delete-button {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 18px;
    }

    .delete-button:hover {
        color: #bb2d3b;
    }
</style>
@endsection
@section('body')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Dashboard</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/dashboard/car-units">Data Mobil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Foto Mobil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Upload Foto Mobil</h5>
                    <hr>
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{url('admin/dashboard/car-units/'.$carUnit->id.'/upload-photos')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="photos">Pilih Foto Mobil (maksimal: 10 foto)</label>
                            <input type="file" id="photos" name="photos[]" multiple class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery-container">
    <h2 class="car-title text-center mb-4">Galeri Foto Mobil: <strong>{{$carUnit->name}}</strong></h2>
    <div class="row">
        @foreach($photos as $photo)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{ asset('storage/'.$photo->file_path) }}" class="card-img-top img-fluid" alt="Car Photo">
                    <div class="card-body text-center">
                    <form class="deleteForm" action="{{ route('car-units.photos.delete', ['carUnitId' => $carUnit->id, 'photoId' => $photo->id]) }}" method="POST" data-photo-id="{{ $photo->id }}"> <!-- Perubahan di sini -->
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-button btn btn-sm btn-danger" data-photo-id="{{ $photo->id }}"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apakah Anda Yakin?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda benar-benar ingin menghapus foto ini? Proses ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
        document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        const confirmDeleteButton = document.getElementById('confirmDelete');
        let formToSubmit;

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const photoId = this.getAttribute('data-photo-id');
                formToSubmit = document.querySelector(`.deleteForm[data-photo-id="${photoId}"]`);
                $('#deleteModal').modal('show');
            });
        });

        confirmDeleteButton.addEventListener('click', function () {
            formToSubmit.submit();
        });
    });
</script>
@endsection
