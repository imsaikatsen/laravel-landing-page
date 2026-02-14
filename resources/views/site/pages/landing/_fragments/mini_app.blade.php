<style>
    .grid-row-5 {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        padding: 0 10px;
    }

    .app-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        transition: transform 0.1s ease;
    }

    .app-card:active {
        transform: scale(0.92);
    }

    .app-icon-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1;
        border-radius: 12px;
        overflow: hidden;
        background: #1a1a1a;
        border: 1px solid #333;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .app-icon-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .app-label {
        font-size: 0.62rem;
        color: #ddd;
        margin-top: 4px;
        text-align: center;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 400;
    }

    .icon-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        color: white;
        font-size: 0.5rem;
        padding: 1px 4px;
        border-radius: 4px;
        z-index: 1;
    }
</style>

<div class="container-fluid pb-2">
    <div class="grid-row-5">
        @foreach ($miniApps as $index => $app)
            <div class="position-relative">
                <a href="{{ route('miniapp.show',$app->slug) }}" class="app-card">
                    <div class="app-icon-wrapper">
                        <img src="/miniapps/{{ $app->appImage }}" alt="{{ $app->appTitle }}">
                    </div>

                    <div class="app-label">
                        {!! hexEncode($app->appTitle) !!}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

{!! $seo['miniapp']->customScript ?? '' !!}