@extends('artikel/template/app')
@section('title', 'Artikel')

@section('content')
   <div class="card mt-4 shadow-sm">
        <img src="/upload/post/{{$artikel->sampul}}" height="400px" class="card-img-top" alt="...">
        <div class="card-body">
            <h3 class="card-title">{{$artikel->judul}}</h3>
            <small class="card-text">
                <span class="text-muted"><a href="/artikel-kategori/{{$artikel->kategori->slug}}">{{$artikel->kategori->nama}}</a></span>
                -
                <span class="text-muted">{{$artikel->created_at->diffForHumans()}}</span>
                -
                <span class="text-muted">Tag :</span>
                @foreach ($artikel->tag as $row)
                    @if ($loop->last)
                        <span class="text-muted"><a href="/artikel-tag/{{$row->slug}}">{{$row->nama}}</a></span>
                    @else
                        <span class="text-muted"><a href="/artikel-tag/{{$row->slug}}">{{$row->nama}},</a></span>
                    @endif
                @endforeach
            </small>
            <br>

            <small>Author : <span class="text-muted"><a href="/artikel-author/{{$artikel->user->id}}">{{$artikel->user->name}}</a></span></small>
            <hr>

            <p class="card-text">{!!$artikel->konten!!}</p>
        </div>
    </div>
@endsection