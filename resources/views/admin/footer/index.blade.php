@extends('sb-admin/app')
@section('title', 'Footer')
@section('footer', 'active')
@section('pengaturan', 'show')
@section('pengaturan-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Footer</h1>

    <form action="/footer/{{$footer->id}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="konten">Copyright</label>
            <input type="text" class="form-control" id="konten" name="konten" value="{{$footer->konten}}">
            @error('konten')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
    </form>
@endsection