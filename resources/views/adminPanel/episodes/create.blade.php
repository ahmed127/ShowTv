@extends('adminPanel.layouts.app')

@section('title', '| Shows:edit')

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
              <li class="breadcrumb-item"><a href="{{route('adminPanel.shows.index')}}">{{ $show->title??''}}</a></li>
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
                <form id="createForm" action="{{ route('adminPanel.shows.episodes.store', $show->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="titleInput" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="descriptionInput">Description</label>
                            <textarea name="description" id="descriptionInput" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="thumbnailInput">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnailInput" value="{{ old('thumbnail') }}" accept="image/*">
                            @error('thumbnail')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="videoInput">Video</label>
                            <input type="file" name="video" class="form-control @error('video') is-invalid @enderror" id="videoInput" value="{{ old('video') }}" accept="video/*">
                            @error('video')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
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

                        <div class="form-group">
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


