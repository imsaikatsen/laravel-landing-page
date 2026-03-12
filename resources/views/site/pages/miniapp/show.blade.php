@extends('site.layouts.main-layout')

@section('page')
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

    .miniapp-admin-btn {
        position: absolute;
        top: 20px;
        right: 75px;
        min-height: 45px;
        padding: 0 16px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.14);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
        z-index: 2;
    }

    .miniapp-admin-btn:hover {
        color: #00ff00;
        border-color: rgba(0, 255, 0, 0.35);
    }

    .miniapp-back-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.14);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
        z-index: 2;
    }

    .miniapp-back-btn:hover {
        color: #00ff00;
        border-color: rgba(0, 255, 0, 0.35);
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

        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}" class="miniapp-back-btn"
            aria-label="Go back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        @auth
            <a href="{{ route('miniapp.edit', $item->id) }}" class="miniapp-admin-btn" target="_blank" rel="noopener noreferrer">
                <i class="fa-solid fa-pen-to-square me-2"></i> Edit
            </a>
        @endauth

        <!-- Floating Like Button -->
        <button class="miniapp-like-btn">
            <i class="fa-solid fa-heart"></i>
        </button>


        <!-- Image -->
        <img src="/miniapps/{{ $item->appImage }}" class="miniapp-image" alt="{{ $item->appTitle }}">

        <!-- Title -->
        <h1 class="miniapp-title">{{ $item->appTitle }}</h1>

        <!-- Description -->
        <div class="miniapp-description">
            {!! $item->description !!}
        </div>



        
    </div>

    <!-- Inject Custom Script / HTML -->
    @if($item->customScript)
        {!! $item->customScript !!}
    @endif

</div>
@endsection
