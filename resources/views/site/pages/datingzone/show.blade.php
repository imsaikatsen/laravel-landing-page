@extends('site.layouts.main-layout')
@section('page') 
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                @if($app->image)
                <img src="{{ asset('datingzones/'.$app->image) }}" class="card-img-top" alt="{{ $app->title }}">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $app->title }}</h2>
                    <div class="mb-2">
                        <span class="badge bg-success"> {{('Likes: ') }} {{ $app->count }}</span>
                        <span class="badge bg-secondary">{{ $app->tag1 }}</span>
                        <span class="badge bg-secondary">{{ $app->tag2 }}</span>
                    </div>

                    <p class="card-text">{{ $app->description }}</p>
                </div>
            </div>

            @if($app->customScript)
                {!! $app->customScript !!}
            @endif
            
        </div>
    </div>
</div>
@endsection
