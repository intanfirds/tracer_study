<div class="d-flex flex-column">
    <div>
        @foreach (session('breadcrumb') ?? [] as $key => $item)
            @if ($item['url'])
                <a class="opacity-5 text-white text-sm" href="{{ $item['url'] }}">{{ $item['label'] }} / </a>
            @endif
        @endforeach
    </div>

    <h6 class="font-weight-bolder text-white mb-0 mt-1">
        {{ session('breadcrumb') ? last(session('breadcrumb'))['label'] : 'Page' }}
    </h6>
</div>
