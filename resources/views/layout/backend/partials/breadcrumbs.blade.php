@if (count($breadcrumbs))
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li><a href="{{ $breadcrumb->url }}">
                            @if($loop->first)
                                <i class="icon-home2 position-left"></i>
                            @endif
                            {{ $breadcrumb->title }}</a></li>
                @else
                    <li class="active">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif