@extends('site.layouts.main-layout')
@section('page')
<style>
    .product-detail-card {
        background-color: #1a1a1a;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #333;
        max-width: 720px;
        margin: 0 auto;
        box-shadow: 0 6px 18px rgba(0,255,0,0.2);
    }

    .product-detail-card img {
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
        margin-bottom: 15px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .product-detail-card img:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 24px rgba(0,255,0,0.3);
    }

    .product-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #00ff00;
        margin-bottom: 10px;
    }

    .product-badges {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .price-badge {
        background: linear-gradient(135deg, #ffc107, #ffd54f);
        color: #000;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.95rem;
    }

    .sold-badge {
        background: linear-gradient(135deg, #32cd32, #00ff00);
        color: #000;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.85rem;
    }

    .rating-stars i {
        color: #ffc107;
        font-size: 0.85rem;
        margin-right: 1px;
    }

    .product-description {
        color: #ccc;
        line-height: 1.5rem;
    }

    .product-detail-card a.buy-btn {
        display: inline-block;
        background: linear-gradient(135deg, #00ff00, #32cd32);
        color: #000;
        font-weight: bold;
        padding: 10px 18px;
        border-radius: 50px;
        text-decoration: none;
        margin-top: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .product-detail-card a.buy-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0,255,0,0.4);
    }
</style>

<div class="px-3 py-4">
    <div class="product-detail-card text-white">

        <div class="product-title">
            {{ $app->title }}
        </div>

        @if($app->image)
            <img src="/mall-products/{{ $app->image }}" alt="{{ $app->title }}">
        @endif

        <div class="product-badges">
            <span class="price-badge">¥ {{ $app->price }}</span>
            <span class="sold-badge">Sold {{ $app->sold_count }}</span>
        </div>

        <div class="rating-stars mb-3">
            @php
                $fullStars = floor($app->rating);
                $halfStar = $app->rating - $fullStars >= 0.5;
            @endphp

            @for ($i = 1; $i <= $fullStars; $i++)
                <i class="fa-solid fa-star"></i>
            @endfor

            @if($halfStar)
                <i class="fa-solid fa-star-half-stroke"></i>
            @endif

            @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                <i class="fa-regular fa-star"></i>
            @endfor

            <span class="text-secondary small"> ({{ $app->review_count . ' Reviews' }})</span>
        </div>

        <div class="product-description">
            {{ $app->description }}
        </div>

        @if($app->customScript)
            {!! $app->customScript !!}
        @endif

        <!-- Optional Buy Button -->
        <a href="#" class="buy-btn">Buy Now</a>
    </div>
</div>

@endsection
