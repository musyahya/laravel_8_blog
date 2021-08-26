@extends('sb-admin/app')
@section('title', 'Post')
@section('post', 'active')
@section('main', 'show')
@section('main-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Post</h1>

    <form action="/post/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="judul">Post</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{old('judul') ? old('judul') : $post->judul}}">
            @error('judul')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-2">
                <img src="/upload/post/{{$post->sampul}}" width="100%" height="150px" class="mt-2" alt="">
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <label for="sampul">Sampul</label>
                    <input type="file" class="form-control" id="sampul" name="sampul">
                    @error('sampul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori">
                        @foreach ($kategori as $row)
                            @if ($row->id == $post->id_kategori)
                                <option value="{{$row->id}}">{{$row->nama}}</option>
                            @endif
                        @endforeach
                        @foreach ($kategori as $row)
                            @if ($row->id != $post->id_kategori)
                                <option value="{{$row->id}}">{{$row->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <select multiple class="form-control" id="tag" name="tag[]">
                @foreach ($tag as $row)
                    <option value="{{$row->id}}"
                        @foreach ($post->tag as $tag_lama)
                            @if ($tag_lama->id == $row->id)
                                selected
                            @endif
                        @endforeach
                    >{{$row->nama}}</option>
                @endforeach
            </select>
            @error('tag')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="editor">Konten</label>
            <textarea class="form-control" id="editor" rows="10" name="konten">{{old('konten') ? old('konten') : $post->konten}}</textarea>
            @error('konten')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
        <a href="/post" class="btn btn-secondary btn-sm">Kembali</a>
    </form>
@endsection

@section('ck-editor')
    @include('ckeditor/setting')
@endsection