@extends('site.layouts.main-layout')
@section('page') 
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                @if($item->image)
                <img src="{{ asset('datingzones/'.$item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $item->title }}</h2>
                    <div class="mb-2">
                        <span class="badge bg-success"> {{('Likes: ') }} {{ $item->count }}</span>
                        <span class="badge bg-secondary">{{ $item->tag1 }}</span>
                        <span class="badge bg-secondary">{{ $item->tag2 }}</span>
                    </div>

                    <p class="card-text">{{ $item->description }}</p>
                </div>
            </div>

            @if($item->customScript)
                {!! $item->customScript !!}
            @endif
            
        </div>
    </div>
</div>
@endsection
