@extends('site.layouts.main-layout')

@section('page') <!-- Make sure layout has @yield('page') -->

@push('meta')
    <title>吴梦梦电视剧在线观看|{{ ($zone->metaTitle) }}</title>
    <meta name="title" content="{{ $zone->metaTitle }}">
    <meta name="keywords" content="{{ $zone->metaKeywords }}">
    <meta name="description" content="{{ $zone->metaDescription }}">
@endpush

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card -->
            <div class="card shadow-sm mb-4">
                @if($zone->image)
                <img src="{{ asset('datingzones/'.$zone->image) }}" class="card-img-top" alt="{{ $zone->title }}">
                @endif

                <div class="card-body">
                    <h2 class="card-title">{{ $zone->title }}</h2>

                    <div class="mb-2">
                        <span class="badge bg-success"> {{('Likes: ') }} {{ $zone->count }}</span>
                        <span class="badge bg-secondary">{{ $zone->tag1 }}</span>
                        <span class="badge bg-secondary">{{ $zone->tag2 }}</span>
                    </div>

                    <p class="card-text">{{ $zone->description }}</p>
                </div>
            </div>

            <!-- Inject Custom Script / HTML -->
            @if($zone->customScript)
                {!! $zone->customScript !!}
            @endif

        </div>
    </div>
</div>
@endsection
