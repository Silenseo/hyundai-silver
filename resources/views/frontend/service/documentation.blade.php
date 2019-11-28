@extends('layouts.master-dealer')

@section('pageTitle', 'Документация')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/service/documentation/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/service/documentation/documentation.css') }}">
@endsection

@section('content')

<section class="head">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="head__banner">
          <div class="head__composition">
            <h1 class="head__title">Документация.</h1>
            <div class="head__subtitle">
              Информация по эксплуатации автомобиля Hyundai.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="calculate">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="calculate__title">
          Выбор автомобиля
        </h2>
        <div class="calculate__slider">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              @foreach($cars as $car)
                <?php if (count($car->manuals) == 0) continue; ?>
              <div class="swiper-slide {{ $loop->first ? 'car-active' : '' }}" data-model="{{ $car->id_text }}">
                <img src="{{ $car->getImageUrl() }}" alt="" class="swiper-slide__img">
                <p class="swiper-slide__desc">{{ $car->name }}</p>
              </div>
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="materials">
  <!-- <h2 class="materials-title">Доступные материалы</h2> -->
  @foreach($cars as $car)
  <div class="materials-content" style="{{ $loop->first ? '' : 'display: none;' }}" data-model="{{ $car->id_text }}">
    <div class="container">
      <div class="row">
        @foreach($car->manuals as $manual)
        <div class="col-lg-4 col-md-6">
          <a href="{{ $manual->getFileUrl() }}" class="materials__item" target="_blank">
            <h3 class="materials__item-title">{{ $manual->name }}</h3>
            <div class="materials__bottom">
              <div class="df-download-link">
                <svg>
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download-link"></use>
                </svg>
                Скачать
              </div>
              <span class="materials__model">{{ $car->name }}</span>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach
</section>

@endsection

@section('scripts')
    <script src="{{ mix('/js/service/documentation/libs.js') }}"></script>
    <script src="{{ mix('/js/service/documentation/documentation.js') }}"></script>
@endsection
