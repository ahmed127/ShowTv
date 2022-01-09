<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
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
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            @include('site.layouts.navbar')
            <section class="content p-4"  style="min-height: 900px;">
                @yield('content')
            </section>
            @include('site.layouts.footer')
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

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
    </body>
</html>
