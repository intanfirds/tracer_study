<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        @hasSection('breadcrumb')
            @yield('breadcrumb')
        @else
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        @endif
    </ol>
</nav>