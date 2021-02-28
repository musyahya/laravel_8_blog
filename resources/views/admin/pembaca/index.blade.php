@extends('sb-admin/app')
@section('title', 'pembaca')
@section('pembaca', 'active')
@section('user', 'show')
@section('user-active', 'active')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pembaca</h1>

   @if ($pembaca[0])
        {{-- table --}}
        <table class="table mt-4 table-hover table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembaca as $row)
                    <tr>
                    <th scope="row" width="15%">{{$loop->iteration}}</th>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{$pembaca->links()}}
   @else
       @if (session('search'))
             {!! session('search') !!}
       @else
            <div class="alert alert-info mt-4" role="alert">
                Anda belum mempunyai data
            </div>
       @endif
   @endif
@endsection

@section('search-url', '/pembaca/search')

@section('search')
    @include('sb-admin/search')
@endsection

@section('search-responsive')
    @include('sb-admin/search-responsive')
@endsection

@section('javascript')
   @include('admin/navbar-mobile')
@endsection