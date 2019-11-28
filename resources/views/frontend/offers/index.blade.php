@extends('layouts.master-dealer')

@section('pageTitle', 'Спецпредложения')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/special/special.css') }}">
@endsection

@section('content')
  <section class="special-title">
    <div class="container">
      <div class="special-title-inner">
        <h1 class="h2">Спецпредложения</h1>
      </div>
    </div>
  </section>

  <div class="special-tabs">
    <div class="special-tabs-inner">
      <div class="tabs-mobile">
        <div class="tabs-mobile-header">
          <span class="tabs-mobile-header__text df-text-radio-button-14px">Все</span>
        </div>
        <div class="tabs-mobile-content">
          <ul class="df-tabs">
            <li class="df-tabs__item">
              <button class="df-tabs__button df-tabs__button--active" data-type="-1" data-button="all">Все</button>
            </li>
            <li class="df-tabs__item">
              <button class="df-tabs__button" data-type="0" data-button="buyers">Покупателям</button>
            </li>
            <li class="df-tabs__item">
              <button class="df-tabs__button" data-type="1" data-button="service">Сервис</button>
            </li>
            <li class="df-tabs__item">
              <button class="df-tabs__button" data-type="2" data-button="leasing">Трейд-ин</button>
            </li>
          </ul>
        </div>
      </div>
      <ul class="df-tabs">
        <li class="df-tabs__item">
          <button class="df-tabs__button df-tabs__button--active" data-type="-1" data-button="all">Все</button>
        </li>
        <li class="df-tabs__item">
          <button class="df-tabs__button" data-type="0" data-button="buyers">Покупателям</button>
        </li>
        <li class="df-tabs__item">
          <button class="df-tabs__button" data-type="1" data-button="service">Сервис</button>
        </li>
        <li class="df-tabs__item">
          <button class="df-tabs__button" data-type="2" data-button="leasing">Трейд-ин</button>
        </li>
      </ul>
    </div>
  </div>

  <section class="special-content">
    <div class="container">
      <div class="row">
        @foreach($offers as $offer)
        <div class="col-lg-3 col-md-6 col-sm-12" data-type="{{ $offer->type }}">
          <div class="special-item">
            <a href="{{ strpos($offer->url, '/') === false ? '/promo/' . $offer->url : $offer->url }}" class="special-item__link">
              <div class="special-item-label">
                <p class="df-text-input-14px">{{ $offer->label->name }}</p>
              </div>
              <div class="special-item-img" style="background-image: url({{ $offer->getImagePreviewUrl() }})"></div>
              <div class="special-item-desc">
                <h4>{!! $offer->name !!}</h4>
              </div>
            </a>
          </div>
        </div>
        @endforeach
<!--
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label">
                <p class="df-text-input-14px">Скидка</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special2.png)"></div>
              <div class="special-item-desc">
                <h4>Победная выгода на автомобили Hyundai.</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label">
                <p class="df-text-input-14px">Кредит</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special3.png)"></div>
              <div class="special-item-desc">
                <h4>Победная выгода на автомобили Hyundai.</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label special-item-label--gray">
                <p class="df-text-input-14px">Трейд-ин</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special4.png)"></div>
              <div class="special-item-desc">
                <h4>Спецпредложение для владельцев Hyundai.</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label special-item-label--gray">
                <p class="df-text-input-14px">Лизинг</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special5.png)"></div>
              <div class="special-item-desc">
                <h4>Лизинг для физических лиц.</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label special-item-label--gray">
                <p class="df-text-input-14px">Трейд-ин</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special6.png)"></div>
              <div class="special-item-desc">
                <h4>H-Promise. Автомобили с пробегом.</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label special-item-label--light">
                <p class="df-text-input-14px">Сервис</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special7.png)"></div>
              <div class="special-item-desc">
                <h4>Бесплатная диагностика + 1 литр масла в подарок.</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label special-item-label--light">
                <p class="df-text-input-14px">Сервис</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special8.png)"></div>
              <div class="special-item-desc">
                <h4>Запчасти PL2. Теперь еще дешевле!</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="special-item">
            <a href="#" class="special-item__link">
              <div class="special-item-label special-item-label--light">
                <p class="df-text-input-14px">Сервис</p>
              </div>
              <div class="special-item-img" style="background-image: url(images/special/special9.png)"></div>
              <div class="special-item-desc">
                <h4>Лучшее для своих.</h4>
              </div>
            </a>
          </div>
        </div>
-->
      </div>
    </div>
  </section>


@endsection

@section('scripts')
    <script src="{{ mix('/js/special/custom.js') }}"></script>
@endsection
