@extends('adminPanel.layouts.app')

@section('title', '| Admins:edit')

@section('breadcrumb')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('adminPanel.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('adminPanel.admins.index')}}">Admins</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Create</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form id="editForm" action="{{ route('adminPanel.admins.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="edit" value="1">
                    <div class="card-body">
                      
                        <div class="form-group col-sm-6">
                            <label for="nameInput">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="nameInput" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="emailInput">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="passwordInput">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" value="{{ old('password') }}">
                            @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="password_confirmationInput">Password confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmationInput" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="statusInput">Role</label>
                          <select name="role" class="form-control">
                              <option value="">Select Role</option>
                              @foreach ($roles as $key => $value)
                                  <option value="{{ $key }}" {{ isset($admin->roles) && $admin->roles[0]->id == $key ? 'selected' : '' }}>{{ $value }}</option>
                              @endforeach
                          </select>
                          @error('role')
                            <p class="text-danger">{{$message}}</p>
                          @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


