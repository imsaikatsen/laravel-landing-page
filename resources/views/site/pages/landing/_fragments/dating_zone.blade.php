<style>
    /* Section Header Styling */
    .dating-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    .dating-title-cn {
        color: #00ff00; /* Neon Green */
        font-size: 1.1rem;
        font-weight: bold;
        margin-right: 8px;
    }
    .dating-title-en {
        color: #777;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Card Styling */
    .dating-card {
        background-color: #1a1a1a;
        border-radius: 15px;
        overflow: hidden;
        border: none;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dating-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    }

    .dating-img {
        width: 100%;
        height: 240px; /* Taller aspect ratio */
        object-fit: cover;
        display: block;
    }

    /* Top Right Like Badge */
    .like-count-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.65rem;
        display: flex;
        align-items: center;
    }

    /* Floating Heart Action Button */
    .heart-action-btn {
        position: absolute;
        bottom: 85px; /* Positioned above the text area */
        right: 10px;
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #ff1493, #ff69b4);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        box-shadow: 0 4px 10px rgba(255, 20, 147, 0.4);
        z-index: 2;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .heart-action-btn:hover {
        transform: scale(1.1);
    }

    /* Content Area Styling */
    .dating-body {
        padding: 12px 10px;
    }
    .dating-name {
        color: #fff;
        font-size: 0.9rem;
        font-weight: bold;
        margin-bottom: 6px;
    }
    .info-row {
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    .label-green {
        color: #00ff00;
        font-size: 0.75rem;
        font-weight: bold;
        margin-right: 5px;
        flex-shrink: 0;
    }
    .info-text-white {
        color: #fff;
        font-size: 0.75rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .info-text-grey {
        color: #00ff00; /* Matching the labels in image */
        font-size: 0.75rem;
        font-weight: bold;
        margin-right: 5px;
    }
    .sub-info-text {
        color: #777;
        font-size: 0.75rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dating-img {
            height: 200px;
        }
    }
    @media (max-width: 576px) {
        .dating-card {
            margin-bottom: 15px;
        }
    }
</style>

<div class="px-3 py-3">
    <div class="dating-header">
        <span class="dating-title-cn">{!! hexEncode('同城交友') !!}</span>
        <span class="dating-title-en">{!! hexEncode('DATING ZONE') !!}</span>
    </div>

    <div class="row g-3">
        @forelse($datingZones as $zone)
        <div class="col-6 col-md-6 col-lg-6">
        <a href="{{ route('datingzone.show', $zone->slug) }}" class="text-decoration-none">
            <div class="dating-card shadow">

                <!-- Likes Badge -->
                <div class="like-count-badge">
                    <i class="bi bi-heart-fill text-white me-1" style="font-size: 0.6rem;"></i>
                    {{ $zone->count }}人喜欢
                </div>

                <!-- Image -->
                <img src="{{ $zone->image ? asset('datingzones/'.$zone->image) : asset('images/placeholder.png') }}" 
                     class="dating-img" 
                     alt="{{ $zone->title }}">

                <!-- Heart Action Button -->
                <button class="heart-action-btn">
                    <i class="fa-solid fa-heart"></i>
                </button>

                <!-- Content -->
                <div class="dating-body">
                    <div class="dating-name"> {!! hexEncode($zone->title) !!}</div>
                    
                    <div class="info-row">
                        <span class="label-green">{!! hexEncode('描述') !!}</span>
                        <span class="info-text-white">{!! hexEncode(Str::limit($zone->description, 80)) !!}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-text-grey">{!! hexEncode('特点') !!}</span>
                        <span class="sub-info-text"> {!! hexEncode($zone->tag1 . ' ' . $zone->tag2) !!}</span>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-4">
            {!! hexEncode('暂无交友区域') !!}
        </div>
        @endforelse
    </div>
</div>

