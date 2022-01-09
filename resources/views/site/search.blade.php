@extends('site.layouts.app')

@section('title', '| Home')

@section('styles') @endsection

@section('content')

    <!-- Default box -->
    <div class="card card-solid" style="min-height: 900px;">
        <div class="card-body pb-0">

            <div class="row">
                <div class="col-6">
                    <h2 class="text-center">Tv Shows</h2>
                    @forelse ($shows as $show)
                        <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="ribbon-wrapper"> <div class="ribbon bg-primary"> {{ $show->amount??'' }} </div> </div>
                            <div class="card-header text-muted border-bottom-0">
                                {{ $show->type_name??'' }} :
                                <b>{{ Str::limit($show->title??'', 50, '...') }}</b>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead">
                                            <b>{{ Str::limit($show->title??'', 50, '...') }}</b>
                                        </h2>

                                        <p class="text-muted text-sm">
                                            <b>Description: </b>
                                            {{ Str::limit($show->description??'', 50, '...') }}
                                        </p>
                                        @foreach ($show->times as $item)
                                            <span class="badge badge-warning">{{ $item->day??'' }} - {{ $item->hour??'' }}</span>
                                        @endforeach
                                        <span class="badge badge-info">{{ $show->amount??'' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{route('site.show', $show->id)}}" class="btn btn-sm bg-teal">More</a>
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
                <div class="col-6">
                    <h2 class="text-center">Episodes</h2>
                    @forelse ($episodes as $episode)
                        <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                            <div class="ribbon-wrapper"> <div class="ribbon bg-primary"> {{ $episode->show->amount??'' }} </div> </div>
                            <div class="card-header text-muted border-bottom-0">
                                {{ $episode->show->type_name??'' }} :
                                <b>{{ Str::limit($episode->show->title??'', 50, '...') }}</b>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead">
                                            <b>{{ Str::limit($episode->title??'', 50, '...') }}</b>
                                        </h2>

                                        <p class="text-muted text-sm">
                                            <b>Description: </b>
                                            {{ Str::limit($episode->description??'', 50, '...') }}
                                        </p>
                                        <span class="badge badge-warning">{{ $episode->day??'' }} - {{ $episode->hour??'' }}</span>
                                        <span class="badge badge-info">{{ $episode->show->amount??'' }}</span>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{asset('uploads_images\\'. $episode->thumbnail)}}" alt="user-avatar" class="img-fluid" width="100">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{ route('site.episode', $episode->id) }}" class="btn btn-sm bg-teal">Episode</a>
                                    <a href="{{ route('site.show', $episode->show_id) }}" class="btn btn-sm btn-primary">{{ $episode->show->type_name??'' }}</a>
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
            </div>
        </div>

    <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@endsection

@section('scripts') @endsection
