@if ($records->hasPages())
@php
    $currentRequest = '';
    foreach (request()->except('page') as $key => $value) {$currentRequest .= '&'.$key.'='.$value;}
@endphp

<div class="card-footer">
    <nav aria-label="Contacts Page Navigation">
        <ul class="pagination justify-content-center m-0">
            @foreach ($records->links()->elements as $array)

                @if ($array != '...')

                    @foreach ($array as $key => $url)
                        <li class="page-item {{request('page',1)==$key?'active':''}}"><a class="page-link" href="{{ $url . $currentRequest }}">{{$key}}</a></li>
                    @endforeach

                @else
                    <li><b>...</b></li>

                @endif
            @endforeach
        </ul>
    </nav>
</div>
@endif
