@extends('layouts.master')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/promo2/promo2.css') }}">
@endsection

@section('content')
<div class="section-top">
    <div class="top-bg">
      <div class="container">
        <a href="#" class="df-back-link">
          Все предложения
          <svg>
            <use xlink:href="#back-link"></use>
          </svg>
        </a>
        <div class="main-img">
          <div class="main-img-inner">
            <img src="/images/promo2/santafe.png" alt="" class="main__img">
            <img src="/images/promo2/santafe-md.png" alt="" class="main__img--md">
          </div>
          <div class="section-title">
            <h1>Новый SANTA&nbsp;FE.</h1>
            <div class="df-banner-subline">Характер победителя</div>
            <div class="section-label">
              <h4 class="section-label-top">от 1 999 000 ₽<br> КАСКО в подарок</h4>
              <h4 class="section-label-bottom">
                <a href="#" class="df-iconed-link df-iconed-link--small">
                  Подробнее
                  <svg>
                    <use xlink:href="#arrow-link"></use>
                  </svg>
                </a>
              </h4>
            </div>
          </div>          
          <div class="section-label">
            <h4 class="section-label-top">от 1 999 000 ₽<br> КАСКО в подарок</h4>
            <h4 class="section-label-bottom">
              <a href="#" class="df-iconed-link df-iconed-link--small">
                Подробнее
                <svg>
                  <use xlink:href="#arrow-link"></use>
                </svg>
              </a>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section-product">
    <div class="container">
      <div class="product-desc">
        <div class="df-text-main-16px product-desc-text">Мы предлагаем вам стать участником программы «Лучшее для своих» и&nbsp;пройти бесплатную диагностику* вашего автомобиля, а&nbsp;также получить подарок при&nbsp;прохождении ТО или&nbsp;масляного сервиса - 1&nbsp;литр масла Shell Helix Ultra*.<br><br>
        Предложение действует для&nbsp;всего модельного ряда Hyundai старше 3&nbsp;лет с&nbsp;момента выпуска автомобиля. Подробности кампании Вы можете уточнить у&nbsp;<a class="df-link-1" href="#">официальных дилеров Hyundai.</a></div>
        <div class="signup-btn">
          <img src="/images/promo2/paper.svg" alt="">
          <span class="signup-btn-text">Записаться</span>
        </div>
      </div>      
      <div class="product-desc product-desc-footer">
        <div class="star">
          *
        </div>
        <div class="df-text-small-12px product-desc-footer-text">Сервисная программа «Лучшее для&nbsp;своих» включает в&nbsp;себя комплексную бесплатную диагностику автомобилей Hyundai старше 2-х&nbsp;лет с&nbsp;момента их выпуска по&nbsp;36 ключевым пунктам без&nbsp;ограничений по&nbsp;сроку эксплуатации и&nbsp;пробегу автомобилей. Клиент может получить бесплатно не&nbsp;более 1&nbsp;литра масла Shell Helix Ultra ECT AH 5W-30 Shell Helix Ultra 0W&nbsp;40 или Shell Helix Ultra 0W&nbsp;30 исходя из&nbsp;общего рекомендованного в&nbsp;сервисной книжке объема только во&nbsp;время проведения замены прежнего масла в&nbsp;автомобиле на&nbsp;полученный в&nbsp;рамках предложения Shell Helix Ultra ECT AH 5W-30 Shell Helix Ultra 0W&nbsp;40 или Shell Helix Ultra 0W&nbsp;30. Лично в&nbsp;руки масло Shell Helix Ultra ECT AH 5W-30 Shell Helix Ultra 0W&nbsp;40 или Shell Helix Ultra 0W&nbsp;30 не выдается.</div>
      </div>  
    </div>
  </div>
@endsection

@section('scripts')

@endsection