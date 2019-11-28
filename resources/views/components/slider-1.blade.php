<!-- Слайдер с OwlCarousel -->
<!-- Подключить карусель, подключить файл со стилями _slider-1.sass, подключить код slider-1.js -->
<section class="slider-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="slider-1__center">
                    <h2 class="slider-1__title">{{ $title }}</h2>
                    <ul class="slider-1__list owl-carousel js-slider-1">
                        @foreach ($slides as $slide)
                            <li class="slider-1__item slider-1__item--{{ $loop->index }}">
                                <div class="slider-1__img">
                                    <img src="{{ $slide['img'] }}" alt="">
                                </div>
                                <div class="slider-1__sub-title">
                                    {{ $slide['title'] }}
                                </div>
                                <div class="slider-1__description df-text-main-16px">
                                    {{ $slide['description'] }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>