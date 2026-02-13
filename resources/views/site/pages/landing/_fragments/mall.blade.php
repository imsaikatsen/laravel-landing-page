<style>
    .mall-title-cn {
        color: #00ff00;
        font-size: 1.15rem;
        font-weight: bold;
        margin-right: 10px;
    }

    .mall-title-en {
        color: #666;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: sans-serif;
    }

    .mall-card {
        background-color: #1a1a1a;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #333;
        height: 100%;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .mall-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,255,0,0.3);
    }

    .mall-card img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }

    .mall-info {
        padding: 8px;
    }

    .product-name {
        font-size: 0.8rem;
        font-weight: bold;
        color: #fff;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 4px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 5px;
    }

    .price-tag {
        color: #ffc107;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .sales-count {
        font-size: 0.65rem;
        color: #666;
    }

    .rating-stars {
        font-size: 0.65rem;
        color: #ffc107;
        margin-top: 2px;
    }
</style>

<div class="px-3 py-3 mb-5">

    <div class="mall-header mb-2">
        <span class="mall-title-cn">{!! hexEncode('情趣商城') !!}</span>
        <span class="mall-title-en">{!! hexEncode('SEX MALL') !!}</span>
    </div>

    <div class="row g-3">

        @forelse($mallProducts as $prod)
            <div class="col-6 mb-2">
                <a href="{{ route('mallproducts.show', $prod->slug) }}" class="text-decoration-none">
                    <div class="mall-card shadow-sm">
                        <div class="position-relative">
                            @if ($prod->image)
                                <img src="/mall-products/{{ $prod->image }}" alt="{{ $prod->title }}">
                            @endif
                        </div>

                        <div class="mall-info">

                            <div class="product-name">
                                {!! hexEncode($prod->title) !!}
                            </div>

                            <div class="price-row">
                                <span class="price-tag"> {!! hexEncode('¥') !!} {{ $prod->price }}</span>
                                <span class="sales-count">{!! hexEncode('Sold') !!} {{ $prod->sold_count }}</span>
                            </div>

                            <div class="rating-row d-flex justify-content-between align-items-center">

                                <div class="rating-stars">
                                    @php
                                        $fullStars = floor($prod->rating);
                                        $halfStar = $prod->rating - $fullStars >= 0.5;
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
                                </div>

                                <span class="text-secondary small">
                                     {{ $prod->review_count }} {!! hexEncode('Reviews') !!}
                                </span>

                            </div>

                        </div>
                    </div>
                </a>
            </div>

        @empty
            <div class="col-12 text-center text-muted small">
                No Products Found
            </div>
        @endforelse

    </div>
</div>
