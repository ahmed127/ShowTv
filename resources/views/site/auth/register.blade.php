<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Show Tv | Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('styles/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Show</b>TV</a>
  </div>

    <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      @include('sessionMessage')
      <form action="{{ route('site.postRegister') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
          {{-- <input type="file" class="form-control" placeholder="Image" name="image"> --}}
          <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-control">
          <img id="output" width="50">
          <script>
            var loadFile = function(event) {
              var output = document.getElementById('output');
              output.src = URL.createObjectURL(event.target.files[0]);
              output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
              }
            };
          </script>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3"> @error('image') <b class="text-danger"> {{$message}}</b> @enderror</div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3"> @error('name') <b class="text-danger"> {{$message}}</b> @enderror</div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3"> @error('email') <b class="text-danger"> {{$message}}</b> @enderror</div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3"> @error('password') <b class="text-danger"> {{$message}}</b> @enderror</div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" value="{{old('password_confirmation')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3"> @error('password_confirmation') <b class="text-danger"> {{$message}}</b> @enderror</div>
        <div class="row">
          <div class="col-8">
            <a href="{{ route('site.login')}}" class="text-center">I already have a membership</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.form-box -->
  </div>

</div>
<!-- /.login-box -->

<script src="{{ asset('styles/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('styles/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('styles/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
