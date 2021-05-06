@extends('sb-admin/app')
@section('title', 'Post')
@section('post', 'active')
@section('main', 'show')
@section('main-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Post</h1>

    <a href="/post/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Post</a>

   @if ($post[0])
        {{-- table --}}
        <table class="table mt-4 table-hover table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Sampul</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Tag</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($post as $row)
                    <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img src="/upload/post/{{$row->sampul}}" alt="" width="80px" height="80px"></td>
                    <td>{{$row->judul}}</td>
                    <td>{{$row->kategori->nama}}</td>
                    <td>
                       @foreach ($row->tag as $tag)
                           <span class="badge badge-secondary">{{$tag->nama}}</span>
                       @endforeach
                    </td>
                    <td width="35%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="/post/{{$row->id}}/rekomendasi" class="btn btn-warning btn-sm mr-1"><i class="{{$row->rekomendasi ? 'fas fa-star' : 'far fa-star'}}"></i> Rekomendasi</a>
                            <a href="/post/{{$row->id}}" class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i> Detail</a>
                            <a href="/post/{{$row->id}}/edit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/post/{{$row->id}}/konfirmasi" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{$post->links()}}
   @else
       @if (session('search'))
             {!! session('search') !!}
       @else
            <div class="alert alert-info mt-4" role="alert">
                Anda belum mempunyai data
            </div>
       @endif
   @endif
@endsection

@section('search-url', '/post/search')

@section('search')
    @include('sb-admin/search')
@endsection

@section('search-responsive')
    @include('sb-admin/search-responsive')
@endsection

@section('javascript')
   @include('admin/navbar-mobile')
@endsection