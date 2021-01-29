@extends('artikel/template/app')
@section('title', 'Artikel')

@section('content')
    <div class="row mt-4">
       @foreach ($artikel as $row)
            <div class="col-md-4">
                <div class="card">
                    <a href="/{{$row->slug}}"><img src="/upload/post/{{$row->sampul}}" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">{{$row->judul}}</h5>
                        <p class="card-text"><small class="text-muted">{{$row->created_at->diffForHumans()}}</small></p>
                    </div>
                </div>
            </div>
       @endforeach
    </div>
@endsection