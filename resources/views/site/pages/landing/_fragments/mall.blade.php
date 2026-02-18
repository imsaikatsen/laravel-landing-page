<div class="px-3 py-3 mb-5">

    <div class="mall-header mb-2">
        <span class="mall-title-cn">情趣商城</span>
        <span class="mall-title-en">SEX MALL</span>
    </div>

    <div class="row g-3">

        @forelse($mallProducts as $prod)
            <div class="col-6 mb-2">
                <a href="{{ route('slug.resolve', $prod->slug) }}" class="text-decoration-none">
                    <div class="mall-card shadow-sm">
                        <div class="position-relative">
                            @if ($prod->image)
                                <img src="/mall-products/{{ $prod->image }}" alt="{{ $prod->title }}">
                            @endif
                        </div>

                        <div class="mall-info">

                            <div class="product-name">
                                {{ $prod->title }}
                            </div>

                            <div class="price-row">
                                <span class="price-tag"> ¥ {{ $prod->price }}</span>
                                <span class="sales-count">Sold {{ $prod->sold_count }}</span>
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
                                     {{ $prod->review_count }} {{('Reviews')}}
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