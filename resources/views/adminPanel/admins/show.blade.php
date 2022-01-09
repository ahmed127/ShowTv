@extends('adminPanel.layouts.app')

@section('title', '| Shows:edit')

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
              <li class="breadcrumb-item"><a href="{{route('adminPanel.shows.index')}}">Shows</a></li>
              <li class="breadcrumb-item active">{{ $show->title??'' }}</li>
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
              <h3 class="card-title">{{ $show->title??'' }}</h3>
            </div>
            <div class="card-body">
              
                <div class="form-group">
                  <label>Type : </label>
                  <b>{{ $show->type??'' }}</b>
                </div>

                <div class="form-group">
                  <label>Title : </label>
                  <b>{{ $show->title??'' }}</b>
                </div>

                <div class="form-group">
                  <label>Description : </label>
                  <b>{{ $show->description??'' }}</b>
                </div>

                <div class="form-group">
                  <label>Price : </label>
                  <b>{{ $show->price??'' }}</b>
                </div>

                <div class="form-group">
                  <label>Status : </label>
                  <b>{{ $show->status??'' }}</b>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


