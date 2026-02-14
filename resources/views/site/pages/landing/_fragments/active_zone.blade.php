<style>
    .zone-card {
        background-color: #1a1a1a;
        border: 1px solid #2d2d2d;
        border-radius: 12px;
        display: flex;
        align-items: center;
        padding: 6px;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .zone-card:active {
        background-color: #252525;
    }

    .zone-image-wrapper {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .zone-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .zone-title {
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 500;
        margin-left: 10px;
        flex-grow: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .zone-arrow-btn {
        background: linear-gradient(90deg, #32cd32, #00ff00);
        color: #000;
        border: none;
        border-radius: 50px;
        width: 28px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 5px;
        box-shadow: 0 0 5px rgba(50, 205, 50, 0.4);
    }

    .zone-arrow-btn i {
        font-size: 0.7rem;
        font-weight: bold;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .section-title-main {
        color: #00ff00;
        font-size: 1.1rem;
        font-weight: bold;
        margin-right: 8px;
    }

    .section-title-sub {
        color: #777;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<div class="px-3 py-2">

    <div class="section-header">
        <span class="section-title-main">{!! hexEncode('直播专区') !!}</span>
        <span class="section-title-sub">{!! hexEncode('LIVE ZONE') !!}</span>
    </div>

    <div class="row g-2">

        @forelse($liveZones as $zone)
            <div class="col-6">
                <a href="{{ route('slug.resolve', $zone->slug) }}" class="zone-card shadow-sm">
                    <div class="zone-image-wrapper">
                        @if ($zone->image)
                            <img src="{{ asset('livezones/' . $zone->image) }}" alt="">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}">
                        @endif
                    </div>

                    <div class="zone-title">
                        {!! hexEncode($zone->title) !!}
                    </div>

                    <div class="zone-arrow-btn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                </a>

            </div>

        @empty
            <div class="col-12 text-center text-muted small">
                No Live Zone Found
            </div>
        @endforelse
    </div>
</div>

