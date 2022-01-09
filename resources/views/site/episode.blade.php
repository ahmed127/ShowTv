@extends('site.layouts.app')

@section('title', '| ' .$episode->show->type_name)

@section('styles') @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid"
                                src="{{asset('uploads_images\\'. $episode->thumbnail)}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $episode->show->type_name??'' }}</h3>
                        @if (!in_array(auth()->id(), $rates))
                            <a href="{{route('site.like', $episode->id) }}" class="btn btn-success col-4"><i class="far fa-thumbs-up mr-1"></i> {{$episode->likes_count}}</a>
                            <a href="{{route('site.dislike', $episode->id) }}" class="btn btn-danger col-4 float-right"><b><i class="far fa-thumbs-down mr-1"></i> {{$episode->dislikes_count}}</b></a>
                        @else
                            <a href="#" class="btn btn-success col-4"><i class="far fa-thumbs-up mr-1"></i> {{$episode->likes_count}}</a>
                            <a href="#" class="btn btn-danger col-4 float-right"><b><i class="far fa-thumbs-down mr-1"></i> {{$episode->dislikes_count}}</b></a>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong> Title</strong>
                        <p class="text-muted"> {{ $episode->title??'' }}</p>

                        <hr>
                        <strong> Description</strong>
                        <p class="text-muted"> {{ $episode->description??'' }} </p>

                        <hr>

                        <strong>Time</strong>
                        <p class="text-muted">{{ $episode->day??'' }} - {{ $episode->hour??'' }}</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        @include('sessionMessage')
                        <div class="row">
                            <div class="col-12">
                                <video width="1330" height="750" controls>
                                    <source src="{{asset('uploads_videos\\'. $episode->video)}}" type="video/mp4">
                                </video>
                            </div>
                        </div>

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
