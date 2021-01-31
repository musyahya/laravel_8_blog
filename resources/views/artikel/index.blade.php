@extends('artikel/template/app')
@section('title', 'Artikel')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide mt-4" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($banner as $row)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{($loop->first) ? 'active' : ''}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($banner as $row)
                <div class="carousel-item {{($loop->first) ? 'active' : ''}}">
                    <a href="/artikel-banner/{{$row->slug}}"><img src="/upload/banner/{{$row->sampul}}" height="400xp" class="d-block w-100" alt="..."></a>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row mt-4">
       @foreach ($artikel as $row)
            <div class="col-md-4">
                <div class="card shadow-sm">
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