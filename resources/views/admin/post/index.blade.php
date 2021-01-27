@extends('sb-admin/app')
@section('title', 'Post')

@section('content')
    {{-- flashdata --}}
    {!! session('sukses') !!}

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
                <th scope="col">Slug</th>
                <th scope="col">Kategori</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($post as $row)
                    <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img src="/upload/post/{{$row->sampul}}" alt="" width="80px" height="80px"></td>
                    <td>{{$row->judul}}</td>
                    <td>{{$row->slug}}</td>
                    <td>{{$row->kategori->nama}}</td>
                    <td width="25%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/post/{{$row->id}}" class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i> Detail</a>
                        <a href="/post/{{$row->id}}/edit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i> Edit</a>
                        <form action="/post/{{$row->id}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data ?')"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{$post->links()}}
   @else
        <div class="alert alert-info mt-4" role="alert">
           Anda belum mempunyai data
        </div>
   @endif
@endsection