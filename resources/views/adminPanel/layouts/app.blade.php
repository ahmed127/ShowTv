<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('styles/dist/css/adminlte.min.css') }}">
    @yield('styles')
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      @include('adminPanel.layouts.navbar')
      @include('adminPanel.layouts.sidebar')

      <div class="content-wrapper">
        @yield('breadcrumb')
        @yield('content')
      </div>

      @include('adminPanel.layouts.footer')

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('styles/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('styles/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('styles/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('styles/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('styles/dist/js/demo.js') }}"></script>
    @yield('scripts')

    @if(request('fillter') == 1)
      <script>
          window.onload=function(){$("#fillterCollapse").click();}
      </script>      
    @endif
    
    @if(old('create') == 1)
      <script>
          window.onload=function(){$("#createModelError").click();}
      </script>
    @endif

    @if(old('edit') == 1)
      <script>
          window.onload=function(){$("#editModelError").click();}
      </script>      
    @endif

  </body>
</html>
