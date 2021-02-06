@extends('sb-admin/app')
@section('title', 'Logo')
@section('logo', 'active')
@section('pengaturan', 'show')
@section('pengaturan-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Logo</h1>

    <form action="/logo/{{$logo->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
       <div class="form-group">
            <label for="logo">Gambar</label>
            <input type="file" class="form-control" id="logo" name="logo">
            @error('logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
        <a href="/logo" class="btn btn-secondary btn-sm">Kembali</a>
    </form>
@endsection
