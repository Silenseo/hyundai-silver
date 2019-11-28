<!-- Слайдер с OwlCarousel -->
<!-- Подключить карусель, подключить файл со стилями _slider-2.sass, подключить код slider-2.js -->
<section class="slider-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-10 offset-lg-1">
                <div class="slider-2__center">
                    <h2 class="slider-2__title">{{ $title }}</h2>
                    <ul class="slider-2__list owl-carousel js-slider-2">
                        @foreach ($slides as $slide)
                            <li class="slider-2__item slider-2__item--{{ $loop->index }}" style="background-image: url({{ $slide['img'] }})">
                                <div class="slider-2__wrap">
                                    <div class="slider-2__sub-title">
                                        {{ $slide['title'] }}
                                    </div>
                                    <div class="slider-2__description df-text-main-16px">
                                        {{ $slide['description'] }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>