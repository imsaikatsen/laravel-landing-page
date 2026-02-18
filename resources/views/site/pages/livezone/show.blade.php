@extends('site.layouts.main-layout')

@push('meta')
    <title>吴梦梦电视剧在线观看|{{ $zone->metaTitle }}</title>
    <meta name="title" content="{{ $zone->metaTitle }}">
    <meta name="keywords" content="{{ $zone->metaKeywords }}">
    <meta name="description" content="{{ $zone->metaDescription }}">
@endpush

@section('page')

    <style>
        .livezone-wrapper {
            padding: 15px;
            color: #fff;
        }

        .livezone-card {
            background: #121212;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(0, 0, 0, .6);
        }

        .livezone-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .livezone-body {
            padding: 15px;
        }

        .livezone-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .livezone-desc {
            font-size: .9rem;
            line-height: 1.6;
            color: #ccc;
        }

        .livezone-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #00ff00, transparent);
            margin: 12px 0;
        }

        .livezone-badge {
            display: inline-block;
            background: linear-gradient(90deg, #00ff00, #32cd32);
            color: #000;
            padding: 3px 10px;
            border-radius: 30px;
            font-size: .7rem;
            margin-bottom: 6px;
        }
    </style>

    <div class="livezone-wrapper">

        <div class="livezone-card">

            @if ($zone->image)
                <div class="livezone-image">
                    <img src="/livezones/{{ $zone->image }}">
                </div>
            @endif

            <div class="livezone-body">

                <span class="livezone-badge">LIVE ZONE</span>

                <div class="livezone-title">
                    {{ $zone->title }}
                </div>

                <div class="livezone-divider"></div>

                <div class="livezone-desc">
                    {{ $zone->description }}
                </div>

                @if ($zone->customScript)
                    <div class="mt-3">
                        {!! $zone->customScript !!}
                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
