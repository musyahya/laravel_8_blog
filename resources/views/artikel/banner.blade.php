@extends('artikel/template/app')
@section('title', 'Banner')

@section('content')
   <div class="card mt-4 shadow-sm">
        <img src="/upload/banner/{{$banner->sampul}}" height="400px" class="card-img-top" alt="...">
        <div class="card-body">
            <h3 class="card-title">{{$banner->judul}}</h3>
            <small class="card-text">
                <span class="text-muted">{{$banner->created_at->diffForHumans()}}</span>
            </small>
            <hr>

            <p class="card-text">{!!$banner->konten!!}</p>
        </div>
    </div>
@endsection