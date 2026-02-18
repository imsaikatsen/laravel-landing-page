@extends('site.layouts.main-layout')

@section('page')


@push('meta')
    <title>吴梦梦电视剧在线观看|{{ $app->metaTitle }}</title>
    <meta name="title" content="{{ $app->metaTitle }}">
    <meta name="keywords" content="{{ $app->metaKeywords }}">
    <meta name="description" content="{{ $app->metaDescription }}">
@endpush


<style>
    .miniapp-card {
        background: #1a1a1a;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 255, 0, 0.2);
        color: #fff;
        position: relative;
        max-width: 800px;
        margin: auto;
    }

    .miniapp-image {
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
        max-height: 400px;
    }

    .miniapp-title {
        font-size: 1.6rem;
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 15px;
        color: #00ff00;
    }

    .miniapp-description {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #ccc;
        margin-bottom: 15px;
    }

    .miniapp-like-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #ff1493, #ff69b4);
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        box-shadow: 0 4px 10px rgba(255, 20, 147, 0.4);
        cursor: pointer;
        z-index: 2;
    }

    .miniapp-like-btn i {
        font-size: 1.1rem;
    }

    /* Optional small info bar below image */
    .miniapp-info-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.85rem;
        color: #aaa;
    }

</style>

<div class="px-3 py-4">

    <div class="miniapp-card">

        <!-- Floating Like Button -->
        <button class="miniapp-like-btn">
            <i class="fa-solid fa-heart"></i>
        </button>


        <!-- Image -->
        <img src="/miniapps/{{ $app->appImage }}" class="miniapp-image" alt="{{ $app->appTitle }}">

        <!-- Title -->
        <h4 class="miniapp-title">{{ $app->appTitle }}</h4>

        <!-- Description -->
        <div class="miniapp-description">
            {{ $app->description }}
        </div>



        
    </div>

    <!-- Inject Custom Script / HTML -->
    @if($app->customScript)
        {!! $app->customScript !!}
    @endif

</div>
@endsection
