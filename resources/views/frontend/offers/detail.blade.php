@extends('layouts.master-dealer')

@section('pageTitle', "Акция от Hyundai: {$offer->head_title}")
@section('pageDescription', "Акции и специальные предложения от компании «Хендэ Мотор СНГ». {$offer->name}")

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/promo1/promo1.css') }}">
  <link rel="stylesheet" href="{{ mix('/css/special/detail.css') }}">
  <link rel="stylesheet" href="{{ mix('/css/promo2/promo2.css') }}">
@endsection

@section('content')
<script>
    window.addEventListener('load', function () {
        document.querySelector('.main-img').classList.add('active');
    })
</script>

<div class="section-top">
    <div class="top-bg">
        <div class="container">
            <a href="/offers" class="df-back-link">
                Все предложения
                <svg>
                    <use xlink:href="#back-link"></use>
                </svg>
            </a>
            <div class="main-img">
            @if($offer->isVideo())
				<div class="detail-video" data-desctop-video="{{ $offer->getVideoDesktopUrl() }}" data-mobile-video="{{ $offer->getVideoMobileUrl() }}"></div>
            @else
                <div class="main-img-inner lazyload lazypreview" data-bgset="{{ $offer->getBannerMobileUrl() }} [(max-width: 640px)] | {{ $offer->getBannerUrl() }}"></div>
            @endif;
                @if($offer->show_header == 1)
                <div class="section-title">
                    <h1>{{ $offer->banner_title }}</h1>
                    <div class="df-banner-subline">{{ $offer->banner_subtitle }}</div>
                </div>

                @endif
                @if($offer->blue_show == 1)
                <div class="blue-panel">
                    <div class="blue-panel__inner">
                        @if(strlen($offer->blue_row1_text) > 0)
                        <div>
                            {{ $offer->blue_row1_text }}
                            <?php
                            switch($offer->blue_row1_type) {
                                case 1: { echo '&nbsp;₽'; break; }
                                case 2: { echo '&nbsp;₽/мес.'; break; }
                                case 3: { echo '&nbsp;<img src="/assets/img/arrow_banner.png">'; break; }
                            };
                            ?>
                        </div>
                        @endif

                        @if(strlen($offer->blue_row2_text) > 0)
                        <div>
                            {{ $offer->blue_row2_text }}
                            <?php
                            switch($offer->blue_row2_type) {
                                case 1: { echo '&nbsp;₽'; break; }
                                case 2: { echo '&nbsp;₽/мес.'; break; }
                                case 3: { echo '&nbsp;<img src="/assets/img/arrow_banner.png">'; break; }
                            };
                            ?>
                        </div>
                        @endif

                        @if(strlen($offer->blue_row3_text) > 0)
                        <div>
                            {{ $offer->blue_row3_text }}
                            <?php
                            switch($offer->blue_row3_type) {
                                case 1: { echo '&nbsp;₽'; break; }
                                case 2: { echo '&nbsp;₽/мес.'; break; }
                                case 3: { echo '&nbsp;<img src="/assets/img/arrow_banner.png">'; break; }
                            };
                            ?>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                @if($offer->show_quick_buttons == 1)
                <div id="hotbuttons">
                    <hot-buttons :buttons="[1,1,1]"></hot-buttons>
                </div>
				@endif
            </div>
        </div>
    </div>
</div>

<div class="section-product" id="offerPage">
    <div class="container">
      <div class="product-desc">
        @if($offer->button_type == 0)
            <div class="df-text-main-16px">{!! $offer->text !!}</div>
        @else
            <div class="df-text-main-16px product-desc-text">{!! $offer->text !!}</div>
            <div class="signup-btn">
                <img src="/images/promo2/paper.svg" alt=""/>
                @if($offer->button_type == 1)
                <a href="/serice-request" class="signup-btn-text">Записаться</a>
                @elseif($offer->button_type == 2)
                <a href="/test-drive" class="signup-btn-text">Тест-драйв</a>
                @elseif($offer->button_type == 3)
                <a href="/find-dealer" class="signup-btn-text">Найти дилера</a>
                @endif
            </div>
        @endif
      </div>
      @foreach($offer->cars()->orderBy('menu_row')->orderBy('menu_column')->get() as $car)
      <div class="product-info">
        <div class="container">
          <div class="row">
            <div class="product-info-mobile col-sm-12">
              <div class="product-info-title">
                <h3>{{ $car->name }}</h3>
              </div>
              <div class="product-info-price">
                <h5>{{ number_format($car->price_min, 0, '', ' ') }} ₽</h5>
              </div>
            </div>
            <div class="product-info-img col-md-6 col-sm-12">
              <img src="{{ $car->getImageUrl() }}" alt="">
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="product-info-title">
                <h3>{{ $car->name }}</h3>
              </div>
              <div class="product-info-price">
                <h5>{{ number_format($car->price_min, 0, '', ' ') }} ₽</h5>
              </div>
              <div class="product-info-buttons">
                <button onclick="document.location.href='/{{ $car->id_text}}'" class="df-button df-button--small">О модели</button>
                <button onclick="document.location.href='/configurator/car/{{ $car->conf_id }}'" class="df-button df-button--small">Конфигуратор</button>
                <button onclick="document.location.href='/test-drive/{{ $car->id_text}}'" class="df-button df-button--small">Тест-драйв</button>
                <button onclick="document.location.href='/configurator/car/{{ $car->conf_id }}/#calculator'" class="df-button df-button--small">Расчет кредита</button>
              </div>
<!--
              <a href="#" class="df-download-link">
                <svg>
                  <use xlink:href="#download-link"></use>
                </svg>
                Скачать брошюру
              </a>
-->
            </div>
          </div>
        </div>
      </div>
      @endforeach

    @if(strlen($offer->disclaimer) > 0)
      <div class="product-desc product-desc-footer">
        <div class="star">
          *
        </div>
        <div class="df-text-small-12px product-desc-footer-text">{!! $offer->disclaimer !!}</div>
      </div>
    @endif
    </div>
  </div>
@endsection

@section('scripts')
	<script src="{{ mix('/js/lazypreview.js') }}"></script>
	<script src="{{ mix('/js/special/libs.js') }}"></script>
	<script src="{{ mix('/js/special/detail.js') }}"></script>
@endsection
