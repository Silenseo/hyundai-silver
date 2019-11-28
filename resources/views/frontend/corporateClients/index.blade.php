@extends('layouts.master-dealer')

@section('pageTitle', 'Корпоративным клиентам')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/corporate/corporate.css') }}">
@endsection

@section('content')

<section class="head">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="head__banner">
          <div class="head__composition">
            <h1 class="head__title">Корпоративным клиентам</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="info">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="info-block">
          <p class="info-text df-text-main-16px">Вне зависимости от&nbsp;размера Вашей компании и&nbsp;Ваших запросов, мы сделаем все, чтобы Вы получили лучшее предложение на&nbsp;рынке корпоративных продаж, предоставим Вам наиболее полный пакет услуг, начиная с&nbsp;профессионального совета по&nbsp;выбору той или иной модели и&nbsp;заканчивая высококачественным послепродажным обслуживанием. Широкая гамма нашего модельного ряда позволит Вам унифицировать корпоративный автопарк, приобрести автомобиль в&nbsp;соответствии с&nbsp;требованиями Вашего бюджета и&nbsp;статуса сотрудника.
          <br><br>
          За более подробной информацией Вы можете обратиться как к&nbsp;любому официальному дилеру Hyundai Motor CIS, так и&nbsp;непосредственно в&nbsp;отдел корпоративных продаж.</p>
          <div class="info-items">
            <div class="info-item">
              <h5 class="info-item__title">Дмитрий Щербаков</h5>
              <p class="info-item__text df-text-small-12px">
                Менеджер по корпоративным продажам
              </p>
              <a href="mailto:DVScherbakov@hyundai.ru" class="df-link-1">DVScherbakov@hyundai.ru</a>
            </div>
            <div class="info-item">
              <h5 class="info-item__title">Ольга Михайлова</h5>
              <p class="info-item__text df-text-small-12px">
                Менеджер по корпоративным продажам
              </p>
              <a href="mailto:OAMikhailova@hyundai.ru" class="df-link-1">OAMikhailova@hyundai.ru</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')

@endsection
