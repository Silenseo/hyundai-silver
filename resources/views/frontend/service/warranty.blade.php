@extends('layouts.master-dealer')

@section('pageTitle', 'Гарантия')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/service/warranty/libs.css') }}">
  <link rel="stylesheet" href="{{ mix('/css/service/warranty/warranty.css') }}">
@endsection

@section('content')

<section class="head">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="head__banner">
          <div class="head__composition">
            <h1 class="head__title">Гарантия.</h1>
            <div class="head__subtitle">
              По всем вопросам технического обслуживания и&nbsp;ремонта автомобиля, включая кузовной ремонт, рекомендуем обращаться только к&nbsp;авторизованным сервисным партнерам Хёндэ (Hyundai).
            </div>
            <a href="#program" class="df-download-img-link">
              <svg>
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-dropdown"></use>
              </svg>
              <span>Что предлагает программа</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="calculate" id="program">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="calculate__title">
          Информация о гарантии
        </h2>
        <p class="warranty__desc">Для поддержания автомобиля в&nbsp;исправном техническом состоянии и&nbsp;сохранения гарантии необходимо соблюдать все правила нормальной эксплуатации автомобиля и&nbsp;рекомендации изготовителя, а&nbsp;также установленный регламент технического обслуживания.</p>
<!--
        <div class="warranty-common">
          <p class="warranty-common__title">Общая гарантия</p>
          <p class="warranty-common__info"><span class="calculate__tab-value">5</span><span class="calculate__tab-unit">лет</span><span class="calculate__tab-value"> / </span><span class="calculate__tab-value">150 000</span><span class="calculate__tab-unit">км пробега</span></p>
          <img src="/images/service/warranty/warranty-info-image-1.jpg" alt="">
        </div>
-->
        <div class="calculate__slider">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              @foreach($cars as $car)
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
        <div class="calculate__inner">
          @foreach($cars as $car)
          <div class="calculate__tabs" data-model="{{ $car->id_text }}" style="{{ $loop->first ? '' : 'display:none;' }}">
            @foreach($car->warranties as $warranty)
            <div class="calculate__tab">
              <div class="calculate__tab-top">
                <h4 class="calculate__tab-title">{{ $warranty->name }}</h4>
                <div class="calculate__tab-info">
                  <div class="calculate__tab-col-1">
                    @if($warranty->period > 0)
                    <span class="calculate__tab-value">{{ $warranty->period }}</span>
                    <span class="calculate__tab-unit">
                    @if($warranty->period == 1)
                    год
                    @elseif($warranty->period < 5)
                    года
                    @else
                    лет
                    @endif
                    </span>
                    @endif
                  </div>
                  <div class="calculate__tab-col-2">
                    @if($warranty->period > 0)
                    <span class="calculate__tab-value">{{ $warranty->mileage }}</span>
                    <div class="calculate__tab-column">
                      <span class="calculate__tab-unit">км.</span>
                      <span class="calculate__tab-unit">пробега</span>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="calculate__tab-inner">
                <div class="calculate__tab-inner-text">{!! $warranty->description !!}</div>
              </div>
            </div>
            @endforeach

           <hr class="tabs-separate">
           @if($car->id_text == 'Solaris')
          <a href="/assets/pdf/warranty/Solaris.pdf" class="calculate-more__link df-download-link solaris-link">
            <svg>
              <use xlink:href="#download-link"></use>
            </svg>
            <span>Подробная информация о&nbsp;всех гарантийных условиях</span>
          </a>
          @elseif($car->id_text == 'Creta')
          <a href="/assets/pdf/warranty/Creta.pdf" class="calculate-more__link df-download-link creta-link">
            <svg>
              <use xlink:href="#download-link"></use>
            </svg>
            <span>Подробная информация о&nbsp;всех гарантийных условиях</span>
          </a>
          @else
          <a href="/assets/pdf/warranty/Other.pdf" class="calculate-more__link df-download-link other-link">
            <svg>
              <use xlink:href="#download-link"></use>
            </svg>
            <span>Подробная информация о&nbsp;всех гарантийных условиях</span>
          </a>
          @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="check">
    <h2 class="check-title">
      Проверьте свой автомобиль по базе сервисных кампаний
    </h2>
    <form action="#" class="check-vin">
      <div class="check-vin__fields">
        <input type="text" class="check-vin__input" placeholder="Введите VIN-номер">
        <div class="check-vin__btn">Проверить</div>
      </div>
      <p class="check-vin__text">Ваш автомобиль не участвует в сервисных кампаниях!</p>
    </form>
  </div>
</section>

<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="copyright-note">
          <img src="/images/service/warranty/note.svg" alt="" class="copyright-note-img">
          ООО «Хендэ&nbsp;Мотор&nbsp;СНГ» продлевает срок ограниченной гарантии, распространяющейся исключительно на&nbsp;механизмы двигателя и&nbsp;детали коробки передач Автомобиля, за&nbsp;исключением навесного оборудования, до&nbsp;5&nbsp;лет или 120&nbsp;000&nbsp;км пробега (в&nbsp;зависимости от&nbsp;того, что наступит ранее) при&nbsp;наличии на&nbsp;Автомобиль Сертификата ограниченной гарантии.
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
  <script src="{{ mix('/js/service/warranty/libs.js') }}"></script>
  <script src="{{ mix('/js/service/warranty/warranty.js') }}"></script>
@endsection
