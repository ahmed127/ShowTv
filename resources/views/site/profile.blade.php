@extends('site.layouts.app')

@section('title', '| My Profile')

@section('styles') @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('site._side_profile')
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <h2>My Profile</h2>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        @include('sessionMessage')
                        <form class="form-horizontal" action="{{ route('site.update_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10 text-center">
                                <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-control" id="iimage" style="display: none">
                                <label for="iimage">
                                    <img id="output" width="50" src="{{asset('uploads_images\\'. $user->image)}}" class="profile-user-img img-fluid img-circle">
                                </label>
                                <script>
                                    var loadFile = function(event) {
                                    var output = document.getElementById('output');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    output.onload = function() {
                                        URL.revokeObjectURL(output.src) // free memory
                                    }
                                    };
                                </script>
                                @error('image') <b class="text-danger"> {{$message}}</b> @enderror
                            </div>

                            </div>

                            <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="inputName" placeholder="Name" name="name" value="{{ old('name', $user->name)}}">
                                @error('name') <b class="text-danger"> {{$message}}</b> @enderror
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ old('email', $user->email)}}">
                                @error('email') <b class="text-danger"> {{$message}}</b> @enderror
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </div>
                        </form>
                        <hr>
                        <form class="form-horizontal" action="{{ route('site.update_password') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="inputOldPassword" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputOldPassword" placeholder="OldPassword" name="old_password" value="">
                                    @error('old_password') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" value="">
                                    @error('password') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPasswordConfirmation" class="col-sm-2 col-form-label">Password Confirmation</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPasswordConfirmation" placeholder="PasswordConfirmation" name="password_confirmation" value="">
                                    @error('password_confirmation') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('scripts') @endsection
