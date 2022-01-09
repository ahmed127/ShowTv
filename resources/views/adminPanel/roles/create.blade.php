@extends('adminPanel.layouts.app')

@section('title', '| Roles:create')

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
              <li class="breadcrumb-item"><a href="{{route('adminPanel.roles.index')}}">Roles</a></li>
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
                <form id="editForm" action="{{ route('adminPanel.roles.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="edit" value="1">
                    <div class="card-body">
                      
                        <div class="form-group">
                            <label for="nameInput">Name Role</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="nameInput" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-sm-12">
                          <table class="table table-bordered">
                              <thead>
                                <th>Model</th>
                                <th  colspan="6">Control</th>
                              </thead>
                              <tbody>
                                  
                                  @php $page = null @endphp

                                  @forelse ($permissions as $permission)
                                      @if ($page != $permission->page)
                                      <tr>
                                          <td>
                                              <strong>{{ $permission->page }}:</strong>
                                          </td>
                                      @endif
                                      <td>
                                          @php 
                                              $checked = old('permissions['. $permission->name .']', isset($roles) ? $roles->hasPermissionTo($permission->name): false );
                                          @endphp
                              
                                          <label>
                                              <input type="checkbox" name="{{ 'permissions['. $permission->name .']' }}" value="{{ $permission->name }}" {{ $checked ? 'checked' : '' }}>
                                              {{ $permission->action }}
                                          </label>
                                      </td>
                                      @php $page = $permission->page @endphp
                                      {{$page != $permission->page ? '</tr>':''}}
                                      @empty
                                      <h3 class="text-danger">No Permission Found</h3>
                                    @endforelse
                              </tbody>
                          </table>
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


