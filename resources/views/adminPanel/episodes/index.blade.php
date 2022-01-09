@extends('adminPanel.layouts.app')

@section('title', '| Episodes')

@section('breadcrumb')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Episodes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('adminPanel.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('adminPanel.shows.index')}}">{{$show->title??''}}</a></li>
              <li class="breadcrumb-item active">Episodes</li>
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
              <h3 class="card-title">Episodes</h3>

              <div class="card-tools">
                @can('episodes create')
                  <a href="{{ route('adminPanel.shows.episodes.create', $show->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i></a>
                @endcan
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @include('sessionMessage')

                <div>
                  <form action="{{ route('adminPanel.shows.episodes.index', $show->id) }}" method="GET">
                      @csrf
                      <div class="card-body row">
                          <div class="form-group col-4">
                              <label for="titleInput">Title</label>
                              <input type="text" name="title" class="form-control" id="titleInput" value="{{ request('title') }}">
                          </div>

                          <div class="form-group col-4">
                              <label for="dayInput">Day</label>
                              <Select name="day" id="dayInput" class="form-control @error('day') is-invalid @enderror">
                                  <option value="">Select Day</option>
                                  @foreach (config('helper.days') as $key => $value)
                                    <option value="{{$key}}" {{old('day') ==  $key? 'Selected':''}}>{{$value}}</option>
                                  @endforeach
                              </Select>
                              @error('day')
                                  <p class="text-danger">{{$message}}</p>
                              @enderror
                          </div>

                          <div class="form-group col-4">
                              <label for="hourInput">Hour</label>
                              <Select name="hour" id="hourInput" class="form-control @error('hour') is-invalid @enderror">
                                  <option value="">Select Hour</option>
                                  @foreach (config('helper.hours') as $key => $value)
                                    <option value="{{$key}}" {{old('hour') ==  $key? 'Selected':''}}>{{$value}}</option>
                                  @endforeach
                              </Select>
                              @error('hour')
                                  <p class="text-danger">{{$message}}</p>
                              @enderror
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
                              <a href="{{ route('adminPanel.shows.episodes.index', $show->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-undo"></i></a>
                          </div>
                      </div>
                  </form>
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 50px">Thumbnail</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Day</th>
                    <th>Hour</th>
                    <th>Like Count</th>
                    <th>Dislike Count</th>
                    <th style="width: 140px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($episodes as $episode)
                    <tr>
                      <td>{{$episode->id??''}}</td>
                      <td>
                        <img src="{{asset('uploads_images\\'. $episode->thumbnail)}}" width="50" height="50">
                      </td>
                      <td>{{ Str::limit($episode->title??'', 50, '...') }}</td>
                      <td>{{$episode->duration??''}}</td>
                      <td>{{$episode->day??''}}</td>
                      <td>{{$episode->hour??''}}</td>
                      <td>{{$episode->likes_count??''}}</td>
                      <td>{{$episode->dislikes_count??''}}</td>
                      <td>
                        <form action="{{ route('adminPanel.episodes.destroy', $episode->id) }}" method="POST">
                          <a href="{{ route('adminPanel.episodes.show', $episode->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
                          @can('episodes edit')
                          <a href="{{ route('adminPanel.episodes.edit', $episode->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt"></i></a>

                          @endcan
                          @can('episodes destroy')
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
              @include('adminPanel.paginate', ['records' => $episodes])
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


