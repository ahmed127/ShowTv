@extends('adminPanel.layouts.app')

@section('title', '| Roles')

@section('breadcrumb')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('adminPanel.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Roles</li>
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
              <h3 class="card-title">Roles</h3>

              <div class="card-tools">
                @can('roles create')
                  <a href="{{ route('adminPanel.roles.create') }}" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i></a>
                @endcan
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @include('sessionMessage')
                <table class="table table-bordered">
                  <thead>
                      <th>Name</th>
                      <th>Action</th>
                  </thead>
                  <tbody>
                  @foreach($roles as $role)
                      <tr>
                          <td>{{ $role->name }}</td>
                          <td>
                          @if($role->id != 1)
                              <form action="{{ route('adminPanel.roles.destroy', $role->id) }}" method="POST">
                                @can('roles edit')
                                <a href="{{ route('adminPanel.roles.edit', $role->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt"></i></a>
                                  @endcan
                                  @can('roles destroy')
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-secondary"><i class="fas fa-trash"></i></button>
                                  @endcan
                            </form>
                          </td>
                          @endif
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


