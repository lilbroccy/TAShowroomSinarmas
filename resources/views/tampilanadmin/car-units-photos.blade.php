@extends('layoutadmin.index')
@section('title', "Car Unit Photos")
@section('body')
<div class="container mt-1">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Car Unit Photos
                        <a href="{{ route('dashboard.car-units') }}" class="btn btn-primary float-right">Back</a>
                    </h4>
                </div>
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

                    <form action="{{url('dashboard/car-units/'.$carUnit->id.'/upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                        <label>Upload Foto Mobil (maks: 10 foto)</label>
                        <input type="file" name="photos[]" multiple class="form control"/>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
@endsection