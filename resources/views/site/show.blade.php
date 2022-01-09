@extends('site.layouts.app')

@section('title', '| ' .$show->type_name)

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
                                src="{{asset('uploads_images\\'. $show->episodes[0]->thumbnail)}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $show->type_name??'' }}</h3>
                        @if (!in_array(auth()->id(), $followers))
                            <a href="{{route('site.follow', $show->id) }}" class="btn btn-primary btn-block"><b>Follow</b></a>
                            @else
                            <a href="{{route('site.unfollow', $show->id) }}" class="btn btn-primary btn-block"><b>Un Follow</b></a>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">description</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong> Title</strong>
                        <p class="text-muted"> {{ $show->title??'' }}</p>

                        <hr>
                        <strong> Description</strong>
                        <p class="text-muted"> {{ $show->description??'' }} </p>

                        <hr>

                        <strong>Time</strong>
                        @foreach ($show->times as $item)
                            <p class="text-muted">{{ $item->day??'' }} - {{ $item->hour??'' }}</p>
                        @endforeach

                        <hr>

                        <strong> Price</strong>
                        <p class="text-muted">  {{ $show->amount??'' }} </p>

                        <hr>

                        <p class="text-muted">
                            @if(in_array(auth()->id(), $purchasers))
                            <a href="#" class="btn btn-primary btn-block"><b>Purchased</b></a>
                            @elseif ($show->price <= auth()->user()->my_money)

                            <a href="{{route('site.purchase_show', $show->id) }}" class="btn btn-primary btn-block"><b>Purchase</b></a>
                            @else
                            <a href="{{route('site.wallet') }}" class="btn btn-primary btn-block"><b>Charge Wallet</b></a>

                            @endif

                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <h2>{{ $show->title??'' }}</h2>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        @include('sessionMessage')
                        <div class="row">
                            @forelse ($show->episodes as $episode)
                            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    {{ $show->type_name??'' }}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead">
                                                <b>{{ Str::limit($episode->title??'', 20, '...') }}</b>
                                            </h2>

                                            <p class="text-muted text-sm">
                                                <b>Description: </b>
                                                {{ Str::limit($episode->description??'', 20, '...') }}
                                            </p>
                                            <span class="badge badge-warning">{{ $episode->day??'' }} - {{ $episode->hour??'' }}</span>
                                            <span class="badge badge-info">{{ $show->amount??'' }}</span>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="{{asset('uploads_images\\'. $episode->thumbnail)}}" alt="user-avatar" class="img-fluid" width="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{ route('site.episode', $show->id) }}" class="btn btn-sm bg-teal">Episode</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <h2 class="text-center"> Empty </h2>
                            </div>
                            @endforelse
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
