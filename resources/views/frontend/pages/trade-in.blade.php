@extends('layouts.master-dealer')

@section('pageTitle', 'Hyundai Trade-in')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/trade-in/libs.css') }}">
  <link rel="stylesheet" href="{{ mix('/css/trade-in/trade-in.css') }}">
@endsection

@section('content')

<section class="head lazyload lazypreview" data-bgset="/images/service/warranty/fon.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="/all-offers" class="df-back-link">
          Все предложения
          <svg>
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#back-link"></use>
          </svg>
        </a>
        <div class="head__banner lazyload lazypreview" data-bgset="/images/trade-in/main-md.jpg [(max-width: 640px)] | /images/trade-in/main.jpg">
          <div class="head__composition">
            <h1 class="head__title">Специальное предложение.</h1>
            <div class="head__subtitle">
              Для владельцев Hyundai.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="benefit">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="benefit-inner">
          <h2 class="benefit__title">Ваша выгода</h2>
          <h4 class="benefit__subtitle">При покупке нового автомобиля в&nbsp;Hyundai Trade-in.</h4>
          <div class="benefit__link">
            <a href="https://hpromise.hyundai.ru/trade-in/" target="_blank" class="df-iconed-link">
              Условия Trade-in
              <svg>
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-link"></use>
              </svg>
            </a>
          </div>
          <div class="benefit__content">
            <div class="benefit__item">
              <div class="benefit__item-header benefit__item-header--mobile">
                <p class="benefit__item-title">CRETA</p>
                <p class="benefit__item-price"><span>957 000</span> — <span>1 335 000</span> ₽</p>
              </div>
              <div class="benefit__img">
                <img src="/images/trade-in/creta.png" alt="">
              </div>
              <div class="benefit__info">
                <div class="benefit__item-header">
                  <p class="benefit__item-title">CRETA</p>
                  <p class="benefit__item-price"><span>957 000</span> — <span>1 335 000</span> ₽</p>
                </div>
                <p class="benefit__item-text">Выгода до 60 000 ₽</p>
                <div class="benefit__item-buttons">
                  <a class="df-button" href="/test-drive/Creta">Тест-драйв</a>
                  <a class="df-button" href="/configurator/car/22">Конфигуратор</a>
                </div>
<!--
                <a href="#" class="df-download-link">
                  <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download-link"></use>
                  </svg>
                  Скачать брошюру
                </a>
-->
              </div>
            </div>
            <div class="benefit__item">
              <div class="benefit__item-header benefit__item-header--mobile">
                <p class="benefit__item-title">Новый TUCSON</p>
                <p class="benefit__item-price"><span>1 499 000</span> — <span>2 269 000</span> ₽</p>
              </div>
              <div class="benefit__img">
                <img src="/images/trade-in/tucson.png" alt="">
              </div>
              <div class="benefit__info">
                <div class="benefit__item-header">
                  <p class="benefit__item-title">Новый TUCSON</p>
                  <p class="benefit__item-price"><span>1 499 000</span> — <span>2 269 000</span> ₽</p>
                </div>
                <p class="benefit__item-text">Выгода до 110 000 ₽</p>
                <div class="benefit__item-buttons">
                  <a class="df-button" href="/test-drive/NewTucson">Тест-драйв</a>
                  <a class="df-button" href="/configurator/car/26">Конфигуратор</a>
                </div>
<!--
                <a href="#" class="df-download-link">
                  <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download-link"></use>
                  </svg>
                  Скачать брошюру
                </a>
-->
              </div>
            </div>
            <div class="benefit__item">
              <div class="benefit__item-header benefit__item-header--mobile">
                <p class="benefit__item-title">Новый SANTA FE</p>
                <p class="benefit__item-price"><span>2 099 000</span> — <span>2 949 000</span> ₽</p>
              </div>
              <div class="benefit__img">
                <img src="/images/trade-in/santa-fe.png" alt="">
              </div>
              <div class="benefit__info">
                <div class="benefit__item-header">
                  <p class="benefit__item-title">Новый SANTA FE</p>
                  <p class="benefit__item-price"><span>2 099 000</span> — <span>2 949 000</span> ₽</p>
                </div>
                <p class="benefit__item-text">Выгода до 160 000 ₽</p>
                <div class="benefit__item-buttons">
                  <a class="df-button" href="/test-drive/NewSantaFe">Тест-драйв</a>
                  <a class="df-button" href="/configurator/car/25">Конфигуратор</a>
                </div>
<!--
                <a href="#" class="df-download-link">
                  <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download-link"></use>
                  </svg>
                  Скачать брошюру
                </a>
-->
              </div>
            </div>
            <div class="benefit__item">
              <div class="benefit__item-header benefit__item-header--mobile">
                <p class="benefit__item-title">SOLARIS</p>
                <p class="benefit__item-price"><span>739 000</span> — <span>999 000</span> ₽</p>
              </div>
              <div class="benefit__img">
                <img src="/images/trade-in/solaris.png" alt="">
              </div>
              <div class="benefit__info">
                <div class="benefit__item-header">
                  <p class="benefit__item-title">SOLARIS</p>
                  <p class="benefit__item-price"><span>739 000</span> — <span>999 000</span> ₽</p>
                </div>
                <p class="benefit__item-text">Выгода до 50 000 ₽</p>
                <div class="benefit__item-buttons">
                  <a class="df-button" href="/test-drive/Solaris">Тест-драйв</a>
                  <a class="df-button" href="/configurator/car/23">Конфигуратор</a>
                </div>
<!--
                <a href="#" class="df-download-link">
                  <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download-link"></use>
                  </svg>
                  Скачать брошюру
                </a>
-->
              </div>
            </div>
            <div class="benefit__item">
              <div class="benefit__item-header benefit__item-header--mobile">
                <p class="benefit__item-title">SONATA</p>
                <p class="benefit__item-price"><span>1 344 000</span> — <span>1 785 000</span> ₽</p>
              </div>
              <div class="benefit__img">
                <img src="/images/trade-in/sonata.png" alt="">
              </div>
              <div class="benefit__info">
                <div class="benefit__item-header">
                  <p class="benefit__item-title">SONATA</p>
                  <p class="benefit__item-price"><span>1 344 000</span> — <span>1 785 000</span> ₽</p>
                </div>
                <p class="benefit__item-text">Выгода до 140 000 ₽</p>
                <div class="benefit__item-buttons">
                  <a class="df-button" href="/test-drive/Sonata">Тест-драйв</a>
                  <a class="df-button" href="/configurator/car/24">Конфигуратор</a>
                </div>
<!--
                <a href="#" class="df-download-link">
                  <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download-link"></use>
                  </svg>
                  Скачать брошюру
                </a>
-->
              </div>
            </div>
            <div class="benefit__item">
              <div class="benefit__item-header benefit__item-header--mobile">
                <p class="benefit__item-title">ELANTRA</p>
                <p class="benefit__item-price"><span>1 049 000</span> — <span>1 315 000</span> ₽</p>
              </div>
              <div class="benefit__img">
                <img src="/images/trade-in/elantra.png" alt="">
              </div>
              <div class="benefit__info">
                <div class="benefit__item-header">
                  <p class="benefit__item-title">ELANTRA</p>
                  <p class="benefit__item-price"><span>1 049 000</span> — <span>1 315 000</span> ₽</p>
                </div>
                <p class="benefit__item-text">Выгода до 50 000 ₽</p>
                <div class="benefit__item-buttons">
                  <a class="df-button" href="/test-drive/NewElantra">Тест-драйв</a>
                  <a class="df-button" href="/configurator/car/7">Конфигуратор</a>
                </div>
<!--
                <a href="#" class="df-download-link">
                  <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download-link"></use>
                  </svg>
                  Скачать брошюру
                </a>
-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="offer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="offer__title">Как воспользоваться предложением?</h2>
        <div class="offer__slider">
          <div class="swiper-container swiper-offer">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="slide__img">
                  <img src="/images/trade-in/computer_2.png" alt="">
                </div>
                <div class="slide__info">
                  <p class="slide__info-step">Шаг 1</p>
                  <p class="slide__info-text">Зарегистрируйтесь в&nbsp;Мире Хёндэ</p>
                  <a href="https://mir.hyundai.ru/" class="df-button">Зарегистрироваться</a>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="slide__img">
                  <img src="/images/trade-in/computer_3.png" alt="">
                </div>
                <div class="slide__info">
                  <p class="slide__info-step">Шаг 2</p>
                  <p class="slide__info-text">Получите сертификат HYUNDAI TRADE-IN</p>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="slide__img">
                  <img src="/images/trade-in/computer_4.png" alt="">
                </div>
                <div class="slide__info">
                  <p class="slide__info-step">Шаг 3</p>
                  <p class="slide__info-text">Посетите дилера и&nbsp;оцените автомобиль</p>
                  <a href="/find-dealer" class="df-button">Найти дилера</a>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="slide__img">
                  <img src="/images/trade-in/computer_5.png" alt="">
                </div>
                <div class="slide__info">
                  <p class="slide__info-step">Шаг 4</p>
                  <p class="slide__info-text">Купите новый Hyundai со&nbsp;скидкой</p>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next swiper-btn"></div>
            <div class="swiper-button-prev swiper-btn"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
  <script src="{{ mix('/js/lazypreview.js') }}"></script>
  <script src="{{ mix('/js/trade-in/libs.js') }}"></script>
  <script src="{{ mix('/js/trade-in/trade-in.js') }}"></script>
@endsection
