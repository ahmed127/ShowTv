@extends('site.layouts.app')

@section('title', '| My Purchase')

@section('styles') @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('site._side_profile')
            <!-- /.col -->
            <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <h2>My Purchase</h2>
                </div><!-- /.card-header -->
                <div class="card-body">

                <div class="row">
                    @forelse ($purchases as $show)
                    <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
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
                                {{-- @if ($show->episodes->count()>0)
                                    <div class="col-5 text-center">
                                        <img src="{{asset('uploads_images\\'. $show->episodes[0]->thumbnail)}}" alt="user-avatar" class="img-fluid" width="100">
                                    </div>
                                @endif --}}
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
                <!-- /.tab-content -->
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
