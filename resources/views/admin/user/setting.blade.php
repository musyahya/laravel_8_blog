@extends('sb-admin/app')
@section('title', 'Setting')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Setting</h1>

    <form action="/user/{{Auth::user()->id}}/setting" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="password_lama">Password Lama</label>
            <input type="password" class="form-control" id="password_lama" name="password_lama">
            @error('password_lama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            {!! session('gagal') !!}
        </div>
        <div class="form-group">
            <label for="password_baru">Password Baru</label>
            <input type="password" class="form-control" id="password_baru" name="password_baru">
            @error('password_baru')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_baru_confirmation">Ulangi Password Baru</label>
            <input type="password" class="form-control" id="password_baru_confirmation" name="password_baru_confirmation">
            @error('password_baru_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
    </form>
@endsection
