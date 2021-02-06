@extends('sb-admin/app')
@section('title', 'Kategori')
@section('kategori', 'active')
@section('main', 'show')
@section('main-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kategori</h1>

    <form action="/kategori/{{$kategori->id}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nama">Kategori</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{$kategori->nama}}">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
        <a href="/kategori" class="btn btn-secondary btn-sm">Kembali</a>
    </form>
@endsection