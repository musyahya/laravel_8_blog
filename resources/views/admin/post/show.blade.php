@extends('sb-admin/app')
@section('title', 'Post')
@section('post', 'active')
@section('main', 'show')
@section('main-active', 'active')

@section('content')
    <a href="/post/{{$post->id}}/edit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
    <a href="/post" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="card mt-3">
        <img src="/upload/post/{{$post->sampul}}" height="450px" class="card-img-top" alt="...">
        <div class="card-body">
            <h2 class="card-title">{{$post->judul}}</h2>
            <p class="card-text">{!!$post->konten!!}</p>
            <p class="card-text"><small class="text-muted">{{$post->created_at->diffForHumans()}}</small></p>
        </div>
    </div>
@endsection