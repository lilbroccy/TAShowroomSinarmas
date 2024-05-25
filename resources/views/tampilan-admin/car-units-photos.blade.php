@extends('layout-admin.index')
@section('title', "Car Unit Photos")
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
<div class="container mt-1">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Nama Mobil: {{$carUnit->name}}</h5>   
                    <hr>
                    @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{url('admin/dashboard/car-units/'.$carUnit->id.'/upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Upload Foto Mobil (maks: 10 foto)</label>
                            <input type="file" name="photos[]" multiple class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        @foreach($photos as $photo)
                            <div class="col-md-3 mb-3">
                                <img src="{{ asset('storage/'.$photo->file_path) }}" class="img-fluid img-thumbnail" alt="Car Photo">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
