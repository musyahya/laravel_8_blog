<!doctype html>
<html lang="en">
{{-- head --}}
    @include('sb-admin/head')

  <body id="page-top">
    {{-- navbar --}}
    @include('artikel/template/navbar')

    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
      @include('sb-admin/footer')

    <!-- Scroll to Top Button-->
    @include('sb-admin/button-topbar')

   {{-- logout --}}
   @include('sb-admin/logout-modal')
  
   {{-- javascript --}}
   @include('sb-admin/javascript')
  </body>
  
</html>