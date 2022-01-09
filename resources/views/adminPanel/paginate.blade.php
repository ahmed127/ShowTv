@if ($records->hasPages())
@php
    $currentRequest = '';
    foreach (request()->except('page') as $key => $value) {$currentRequest .= '&'.$key.'='.$value;}
@endphp
<ul class="pagination pagination-sm m-0 float-right">
    <li class="page-item"><a class="page-link" href="{{$records->previousPageUrl().$currentRequest}}">&laquo;</a></li>
    @foreach ($records->links()->elements as $array)

        @if ($array != '...')

            @foreach ($array as $key => $url)
                <li class="page-item"><a class="page-link {{request('page',1)==$key?'bg-primary':''}}" href="{{ $url . $currentRequest }}">{{$key}}</a></li>
            @endforeach

        @else
            <li><b>...</b></li>

        @endif
    @endforeach
    <li class="page-item"><a class="page-link" href="{{$records->nextPageUrl().$currentRequest}}">&raquo;</a></li>
</ul>

@endif
