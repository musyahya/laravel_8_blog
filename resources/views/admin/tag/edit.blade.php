@extends('sb-admin/app')
@section('title', 'Tag')
@section('tag', 'active')
@section('main', 'show')
@section('main-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tag</h1>

    <form action="/tag/{{$tag->id}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nama">Tag</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{$tag->nama}}">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
        <a href="/tag" class="btn btn-secondary btn-sm">Kembali</a>
    </form>
@endsection