<div class="hero-container p-2">

    <div id="heroSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">

        <div class="carousel-inner rounded-3 overflow-hidden border border-secondary shadow-sm">

            @foreach ($sliders as $key => $slider)
                <div class="carousel-item @if ($key == 0) active @endif">
                    <img src="/sliders/{{ $slider->image }}" class="d-block w-100 object-fit-cover" style="height:200px"
                        alt="slider">
                </div>
            @endforeach

        </div>

    </div>

</div>
