{{-- @include('site._episode', [
    'show_id' => ,
    'episode_id' => ,
    'type_name' => ,
    'title' => ,
    'description' => ,
    'day' => ,
    'hour' => ,
    'thumbnail' => ,
]) --}}
<div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
            {{ $type_name }}
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-7">
                    <h2 class="lead">
                        <b>{{ Str::limit($title, 20, '...') }}</b>
                    </h2>

                    <p class="text-muted text-sm">
                        {{ Str::limit($description, 20, '...') }}
                    </p>
                    <span class="badge badge-warning">{{ $day }} - {{ $hour }}</span>
                </div>
                <div class="col-5 text-center">
                    <img src="{{asset('uploads_images\\'. $thumbnail)}}" alt="user-avatar" class="img-fluid" width="100">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('site.episode', $episode_id) }}" class="btn btn-sm bg-teal">Episode</a>
                @if ($purchase)
                    <a href="{{ route('site.show', $show_id) }}" class="btn btn-sm bg-primary">Purchase Now</a>
                @endif
            </div>
        </div>
    </div>
</div>
