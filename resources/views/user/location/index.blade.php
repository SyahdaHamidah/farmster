@extends('homedashboard.blank')
@section('title','Category')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session('success') }}
</div>
@endif

<a href="{{ route('form') }}" class="btn btn-info bts-sm">Add Farm</a>
<br><br>
<table class="table table-striped table-hover table-sm table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Privinsi</th>
            <th>Nama Peternakan</th>
            <th>Jenis Peternakan</th>
            <th>Alamat</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($farm as $result => $hasil)
        <tr>
            <td>{{$hasil ->id}}</td>
            <td>{{ $hasil->provinsi }}</td>
            <td>{{ $hasil->nama_peternakan }}</td>
            <td>{{ $hasil->jenis_peternakan }}</td>
            <td>{{ $hasil->alamat }}</td>
            <td>{{ $hasil->lat }}</td>
            <td>{{ $hasil->lng }}</td>
            <td>
                <form action="{{ route('delete', $hasil->id ) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- {{ $farm->links() }} --}}
@endsection