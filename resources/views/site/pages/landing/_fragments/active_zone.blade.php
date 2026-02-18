<div class="px-3 py-2">

    <div class="section-header">
        <span class="section-title-main">直播专区</span>
        <span class="section-title-sub">LIVE ZONE</span>
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
                        {{ $zone->title }}
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

