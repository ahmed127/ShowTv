@extends('adminPanel.layouts.app')

@section('title', '| Episodes:edit')

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
            <li class="breadcrumb-item"><a href="{{route('adminPanel.shows.index')}}">Shows</a></li>
            <li class="breadcrumb-item"><a href="{{route('adminPanel.shows.episodes.index', $episode->show_id)}}">Episodes</a></li>
            <li class="breadcrumb-item active">View</li>
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
              <h3 class="card-title">View</h3>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label>Title : </label>
                <b>{{ $episode->title??'' }}</b>
              </div>

              <div class="form-group">
                <label>Description : </label>
                <b>{{ $episode->description??'' }}</b>
              </div>

              <div class="form-group">
                <label>Duration : </label>
                <b>{{ $episode->duration??'' }}</b>
              </div>

              <div class="form-group">
                <label>Thumbnail : </label>
                <img src="{{asset('uploads_images\\'. $episode->thumbnail)}}" width="150" height="150">
              </div>

              <div class="form-group">
                <label>Video : </label>
                <video width="250" height="350" controls>
                  <source src="{{asset('uploads_videos\\'. $episode->video)}}" type="video/mp4">
                </video>
              </div>

              <div class="form-group">
                <label>Day : </label>
                <b>{{ $episode->day??'' }}</b>
              </div>

              <div class="form-group">
                <label>Hour : </label>
                <b>{{ $episode->hour??'' }}</b>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


