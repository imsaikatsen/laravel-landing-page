@extends('site.layouts.main-layout')

@section('page') <!-- Make sure layout has @yield('page') -->

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card -->
            <div class="card shadow-sm mb-4">
                @if($zone->image)
                <img src="{{ asset('datingzones/'.$zone->image) }}" class="card-img-top" alt="{{ $zone->title }}">
                @endif

                <div class="card-body">
                    <h2 class="card-title">{!! hexEncode($zone->title) !!}</h2>

                    <div class="mb-2">
                        <span class="badge bg-success"> {!! hexEncode('Likes: ') !!} {{ $zone->count }}</span>
                        <span class="badge bg-secondary">{!! hexEncode($zone->tag1) !!}</span>
                        <span class="badge bg-secondary">{!! hexEncode($zone->tag2) !!}</span>
                    </div>

                    <p class="card-text">{!! hexEncode($zone->description) !!}</p>
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
