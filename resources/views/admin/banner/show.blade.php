@extends('sb-admin/app')
@section('title', 'Banner')
@section('banner', 'active')
@section('main', 'show')
@section('main-active', 'active')

@section('content')
    <a href="/banner/{{$banner->id}}/edit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
    <a href="/banner" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="card mt-3">
        <img src="/upload/banner/{{$banner->sampul}}" height="450px" class="card-img-top" alt="...">
        <div class="card-body">
            <h2 class="card-title">{{$banner->judul}}</h2>
            <p class="card-text">{!!$banner->konten!!}</p>
            <p class="card-text"><small class="text-muted">{{$banner->created_at->diffForHumans()}}</small></p>
        </div>
    </div>
@endsection