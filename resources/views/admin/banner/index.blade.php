@extends('sb-admin/app')
@section('title', 'Banner')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Banner</h1>

    <a href="/banner/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Banner</a>

   @if ($banner[0])
        {{-- table --}}
        <table class="table mt-4 table-hover table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Sampul</th>
                <th scope="col">Judul</th>
                <th scope="col">Slug</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banner as $row)
                    <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img src="/upload/banner/{{$row->sampul}}" alt="" width="80px" height="80px"></td>
                    <td>{{$row->judul}}</td>
                    <td>{{$row->slug}}</td>
                    <td width="25%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="/banner/{{$row->id}}" class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i> Detail</a>
                            <a href="/banner/{{$row->id}}/edit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/banner/{{$row->id}}/konfirmasi" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{$banner->links()}}
   @else
        <div class="alert alert-info mt-4" role="alert">
           Anda belum mempunyai data
        </div>
   @endif
@endsection