<div class="px-3 py-3">
    <div class="dating-header">
        <span class="dating-title-cn">同城交友</span>
        <span class="dating-title-en">DATING ZONE</span>
    </div>

    <div class="row g-3">
        @forelse($datingZones as $zone)
        <div class="col-6 col-md-6 col-lg-6">
        <a href="{{ route('slug.resolve', $zone->slug) }}" class="text-decoration-none">
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
                    <div class="dating-name"> {{ $zone->title }}</div>
                    
                    <div class="info-row">
                        <span class="label-green">描述</span>
                        <span class="info-text-white">{{ Str::limit($zone->description, 80) }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-text-grey">特点</span>
                        <span class="sub-info-text"> {{ $zone->tag1 . ' ' . $zone->tag2 }}</span>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-4">
            暂无交友区域
        </div>
        @endforelse
    </div>
</div>

