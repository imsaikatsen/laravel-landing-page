


<div class="container-fluid pb-2">
    <div class="grid-row-5">
        @foreach ($miniApps as $index => $app)
            <div class="position-relative">
                <a href="{{ route('slug.resolve', $app->slug) }}" class="app-card">
                    <div class="app-icon-wrapper">
                        <img src="/miniapps/{{ $app->appImage }}" alt="{{ $app->appTitle }}">
                    </div>

                    <div class="app-label">
                        {{ $app->appTitle }}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
