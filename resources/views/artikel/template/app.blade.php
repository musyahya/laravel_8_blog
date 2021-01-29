<!doctype html>
<html lang="en">
{{-- head --}}
    @include('artikel/template/head')
  <body>
    {{-- navbar --}}
    @include('artikel/template/navbar')

    <div class="container">
        @yield('content')
    </div>

   {{-- javascript --}}
   @include('artikel/template/javascript')
  </body>
</html>