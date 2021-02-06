@extends('sb-admin/app')
@section('title', 'Tag')
@section('tag', 'active')
@section('main', 'show')
@section('main-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tag</h1>

    <form action="/tag" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Tag</label>
            <input type="text" class="form-control" id="nama" name="nama">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
        <a href="/tag" class="btn btn-secondary btn-sm">Kembali</a>
    </form>
@endsection