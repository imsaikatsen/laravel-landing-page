@extends('site.layouts.main-layout')
@section('page')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body border-bottom d-flex justify-content-between align-items-center">
                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back
                    </a>
                    @auth
                        <a href="{{ route('datingzone.edit', $item->id) }}" class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener noreferrer">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                        </a>
                    @endauth
                </div>
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

                    <div class="card-text">{!! $item->description !!}</div>
                </div>
            </div>

            @if($item->customScript)
                {!! $item->customScript !!}
            @endif
            
        </div>
    </div>
</div>
@endsection
