@extends('site.layouts.app')

@section('title', '| ' .$show->type_name)

@section('styles') @endsection

@section('content')
    @php $user = auth()->user(); @endphp
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
                        @if (!in_array($user->id, $followers))
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
                        <h3 class="card-title">Details</h3>
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
                            @if(in_array($user->id, $purchasers))
                            <a href="#" class="btn btn-primary btn-block"><b>Purchased</b></a>
                            @elseif ($show->price <= $user->my_money)

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
                                @include('site._episode', [
                                    'show_id' => $episode->show_id??'',
                                    'episode_id' => $episode->id??'',
                                    'type_name' => $show->type_name??'',
                                    'title' => $episode->title??'',
                                    'description' => $episode->description??'',
                                    'day' => $episode->day??'',
                                    'hour' => $episode->hour??'',
                                    'thumbnail' => $episode->thumbnail??'',
                                    'purchase' => false,
                                ])
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
