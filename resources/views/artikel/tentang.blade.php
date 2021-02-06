@extends('artikel/template/app')
@section('title', 'Tentang Kami')
@section('tentang', 'active')

@section('content')
   <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h3 class="card-title">Tentang Kami</h3>

            <p class="card-text">{!!$tentang->konten!!}</p>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <a href="{{$tentang->facebook}}">
                    <div class="card-body bg-primary text-center m-3">
                        <i class="fab fa-facebook-f fa-3x text-white"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
               <a href="{{$tentang->instagram}}">
                    <div class="card-body bg-danger text-center m-3">
                        <i class="fab fa-instagram fa-3x text-white"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{$tentang->twitter}}">
                    <div class="card-body bg-info text-center m-3">
                        <i class="fab fa-twitter fa-3x text-white"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection