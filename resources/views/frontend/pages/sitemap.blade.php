@extends('layouts.master')

@section('pageTitle', 'Sitemap')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/sitemap.css') }}">
@endsection

@section('content')

<section class="head">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="head__banner">        
          <div class="head__composition">
            <div class="sitemap__row sitemap__row--models">
              <h3 class="sitemap__row-title">Модельный ряд</h3>                
              <ul class="sitemap__row-list">
                @foreach($menu_cars as $menu_car)
                  @if(isset($menu_car['items']))
                    @foreach($menu_car['items'] as $car)
                    <li class="sitemap__row-item">
                      <a href="{{ $car->id_text }}" class="sitemap__row-link">{{ $car->name_menu_rus }}</a>
                    </li>
                    @endforeach
                  @endif
                @endforeach
              </ul>
            </div>
            <div class="sitemap__row sitemap__row--service">
              <h3 class="sitemap__row-title">Сервис</h3>
              <ul class="sitemap__row-list">
                @foreach($menu_service as $service_cat)
                  @foreach($service_cat as $title => $link)
                    <li class="sitemap__row-item">
                      <a href="{{ $link }}" class="sitemap__row-link">{{ $title }}</a>
                    </li>
                  @endforeach
                @endforeach
              </ul>
            </div>
            <div class="sitemap__row sitemap__row--buy">
              <h3 class="sitemap__row-title">Покупка</h3>
              <ul class="sitemap__row-list">
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Найти дилера</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Запись на&nbsp;сервис</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Конфигуратор</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Тест-драйв</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Спецпредложения</a>
                </li>
              </ul>
            </div>
            <div class="sitemap__row sitemap__row--about">
              <h3 class="sitemap__row-title">О нас</h3>
              <ul class="sitemap__row-list">
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Хенде Мотор СНГ</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Стать дилером</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Производство</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Заполнить анкету</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Обзор</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Тендеры ХМСНГ</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Вакансии завода</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Контакты</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Карьера в Hyundai</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">XMMP</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Трудоустройство</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Социальная ответственность</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Партнеры</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">О&nbsp;заводе</a>
                </li>
              </ul>
            </div>
            <div class="sitemap__row sitemap__row--media">
              <h3 class="sitemap__row-title">Медиа-центр</h3>
              <ul class="sitemap__row-list">
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Новости компании</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">CIS</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Журнал Hyundai Motor</a>
                </li>
                <li class="sitemap__row-item">
                  <a href="#" class="sitemap__row-link">Награды</a>
                </li>
              </ul>
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
