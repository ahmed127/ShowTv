@extends('adminPanel.layouts.app')

@section('title', '| Admins')

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
              <li class="breadcrumb-item active">Admins</li>
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
              <h3 class="card-title">Admins</h3>

              <div class="card-tools">
                @can('admins create')
                  <a href="{{ route('adminPanel.admins.create') }}" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i></a>
                @endcan
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('sessionMessage')
                <div>
                  <form action="{{ route('adminPanel.admins.index') }}" method="GET">
                      @csrf

                      <div class="card-body row">
                          <div class="form-group col-4">
                              <label for="nameInput">Name</label>
                              <input type="text" name="name" class="form-control" id="nameInput" value="{{ request('name') }}">
                          </div>

                          <div class="form-group col-4">
                              <label for="emailInput">Email</label>
                              <input type="email" name="email" class="form-control" id="emailInput" value="{{ request('email') }}">
                          </div>

                          <div class="form-group col-4">
                              <label for="paginationInput">Pagination</label>
                              <Select name="pagination" id="typeInput" class="form-control">
                                  <option value="5"{{request('pagination') ==  5? 'Selected':''}}>5</option>
                                  <option value="10"{{request('pagination') ==  10? 'Selected':''}}>10</option>
                                  <option value="20"{{request('pagination') ==  20? 'Selected':''}}>20</option>
                                  <option value="30"{{request('pagination') ==  30? 'Selected':''}}>30</option>
                                  <option value="100"{{request('pagination') ==  100? 'Selected':''}}>100</option>
                              </Select>
                          </div>

                          <div class="form-group col-12">
                              <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
                              <a href="{{ route('adminPanel.admins.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-undo"></i></a>
                          </div>
                      </div>
                  </form>
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="width: 140px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($admins as $admin)
                    <tr>
                      <td>{{$admin->id??''}}</td>
                      <td>{{$admin->name??''}}</td>
                      <td>{{$admin->email??''}}</td>
                      <td>{{$admin->roles[0]->name??''}}</td>
                      <td>

                        <form action="{{ route('adminPanel.admins.destroy', $admin->id) }}" method="POST">
                          @can('admins edit')
                          <a href="{{ route('adminPanel.admins.edit', $admin->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt"></i></a>
                          @endcan
                          @can('admins destroy')
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-secondary"><i class="fas fa-trash"></i></button>
                          @endcan
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              @include('adminPanel.paginate', ['records' => $admins])
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


