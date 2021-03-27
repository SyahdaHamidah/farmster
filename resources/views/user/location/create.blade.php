@extends('homedashboard.blank')
@section('title','Add Farm')
@section('content')

@if(count($errors)>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>
@endforeach
@endif

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session('success') }}
</div>
@endif

<form action="{{ route('createfarm') }}" method="POST">
    @csrf
    <input type="hidden" name="author" value="{{Auth::user()->name}}" id="author">
    <div class="form-group">
        <label>Provinsi</label>
        <input type="text" class="form-control" name="prov">
    </div>
    <div class="form-group">
        <label>Nama Peternakan</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label>Jenis Peternakan</label>
        <input type="text" class="form-control" name="jenis">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat">
    </div>
    <div class="form-group">
        <label>Latitude</label>
        <input type="text" class="form-control" name="lat">
    </div>
    <div class="form-group">
        <label>Longitude</label>
        <input type="text" class="form-control" name="lng">
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Save</button>
    </div>
</form>
@endsection