@extends('site.layouts.app')

@section('title', '| Home')

@section('styles') @endsection

@section('content')
    <!-- Default box -->
    <div class="card card-solid" style="min-height: 900px;">
    <div class="card-body pb-0">
        <div class="row">
            @forelse ($episodes as $episode)
                @include('site._episode', [
                    'show_id' => $episode->show_id??'',
                    'episode_id' => $episode->id??'',
                    'type_name' => $episode->show->type_name??'',
                    'title' => $episode->title??'',
                    'description' => $episode->description??'',
                    'day' => $episode->day??'',
                    'hour' => $episode->hour??'',
                    'thumbnail' => $episode->thumbnail??'',
                    'purchase' => true,
                ])
            @empty
                <div class="col-12">
                    <h2 class="text-center"> Empty </h2>
                </div>
            @endforelse
        </div>
    </div>
    <!-- /.card-body -->
    @include('site.paginate', ['records' => $episodes])

    <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@endsection

@section('scripts') @endsection
