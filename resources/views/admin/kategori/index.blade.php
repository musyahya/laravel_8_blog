@extends('sb-admin/app')
@section('title', 'Kategori')

@section('content')
    {{-- flashdata --}}
    {!! session('sukses') !!}

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kategori</h1>

    <a href="/kategori/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Kategori</a>

    {{-- table --}}
    <table class="table mt-4 table-hover table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Slug</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $row)
                <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$row->nama}}</td>
                <td>{{$row->slug}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection