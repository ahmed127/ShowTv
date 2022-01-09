@extends('adminPanel.layouts.app')

@section('title', '| Shows')

@section('breadcrumb')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Shows</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('adminPanel.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Shows</li>
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
              <h3 class="card-title">Shows</h3>

              <div class="card-tools">

                @can('shows create')
                  <a href="{{ route('adminPanel.shows.create') }}" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i></a>
                @endcan
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @include('sessionMessage')

                <div>
                  <form action="{{ route('adminPanel.shows.index') }}" method="GET">
                      @csrf
                      <div class="card-body row">
                          <input type="hidden" name="fillter" value="1">
                          <div class="form-group col-4">
                              <label for="typeInput">Type</label>
                              <Select name="type" id="typeInput" class="form-control">
                                  <option value="">Select Type</option>
                                  <option value="1"{{request('type') ==  1? 'Selected':''}}>Series</option>
                                  <option value="2"{{request('type') ==  2? 'Selected':''}}>TV</option>
                              </Select>
                          </div>
                          <div class="form-group col-4">
                              <label for="titleInput">Title</label>
                              <input type="text" name="title" class="form-control" id="titleInput" value="{{ request('title') }}">
                          </div>
                          <div class="form-group col-4">
                              <label for="priceInput">Price</label>
                              <input type="number" name="price" class="form-control" id="priceInput" value="{{ request('price') }}">
                          </div>

                          <div class="form-group col-4">
                              <label for="statusInput">Status</label>
                              <Select name="status" id="typeInput" class="form-control">
                                  <option value="">Select Status</option>
                                  <option value="1"{{request('status') ==  1? 'Selected':''}}>Active</option>
                                  <option value="0"{{request('status') ==  0? 'Selected':''}}>Inactive</option>
                              </Select>
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
                              <a href="{{ route('adminPanel.shows.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-undo"></i></a>
                          </div>
                      </div>
                  </form>
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Episodes Count</th>
                    <th>Followers Count</th>
                    <th>Status</th>
                    <th style="width: 140px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($shows as $show)
                    <tr>
                      <td>{{$show->id??''}}</td>
                      <td>{{$show->type_name}}</td>
                      <td>{{$show->title??''}}</td>
                      <td>{{$show->amount??''}}</td>
                      <td>
                        <a href="{{ route('adminPanel.shows.episodes.index', $show->id) }}" class="btn btn-sm btn-secondary">
                          {{$show->episodes_count??0}}
                        </a>
                      </td>
                      <td>{{$show->followers_count??''}}</td>
                      <td>{{$show->status_name}}</td>
                      <td>
                        <form action="{{ route('adminPanel.shows.destroy', $show->id) }}" method="POST">
                          <a href="{{ route('adminPanel.shows.show', $show->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
                          @can('shows edit')
                          <a href="{{ route('adminPanel.shows.edit', $show->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt"></i></a>
                          @endcan
                          @can('shows destroy')
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
              @include('adminPanel.paginate', ['records' => $shows])
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


