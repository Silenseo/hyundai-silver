﻿@extends('layouts.master-dealer')

@section('pageTitle', 'Creta')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/creta/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/creta/creta.css') }}">
@endsection

@section('content')

<section class="nav">
    <ul class="nav__menu">
        <li class="nav__item">
            <a href="{{ route('static_car22') }}#design" class="nav__link scroll">
                Дизайн
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car22') }}#dynamics" class="nav__link scroll">
                Динамика
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car22') }}#comfort" class="nav__link scroll">
                Комфорт
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car22') }}#safety" class="nav__link scroll">
                Безопасность
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car22') }}#specs" class="nav__link scroll">
                Характеристики
            </a>
        </li>
        <li class="nav__item">
            <a target="_blank" href="{{ route('static_car22') }}/gallery" class="nav__link active">
                Галерея
            </a>
        </li>
    </ul>
    <div class="nav__buttons">
        <a target="_blank" href="/test-drive/Creta" class="df-button nav__button">
            Тест-драйв
        </a>
        <a target="_blank" href="/configurator/car/22" class="df-button nav__button">
            Конфигуратор
        </a>
        <a target="_blank" href="/find-dealer" class="df-button nav__button">
            Найти дилера
        </a>
    </div>
</section>

<section class="gallery">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="h2 mb-5 text-center">Галерея Creta</h1>
				<div class="gallery__wrapper">
					<ul id="gallery" class="gallery__list">
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_1.jpg" style="background-image: url(/images/cars/creta/slider/gallery_1.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_2.jpg" style="background-image: url(/images/cars/creta/slider/gallery_2.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_3.jpg" style="background-image: url(/images/cars/creta/slider/gallery_3.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_4.jpg" style="background-image: url(/images/cars/creta/slider/gallery_4.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_5.jpg" style="background-image: url(/images/cars/creta/slider/gallery_5.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/creta/slider/gallery_6.jpg" style="background-image: url(/images/cars/creta/slider/gallery_6.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_7.jpg" style="background-image: url(/images/cars/creta/slider/gallery_7.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_8.jpg" style="background-image: url(/images/cars/creta/slider/gallery_8.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_9.jpg" style="background-image: url(/images/cars/creta/slider/gallery_9.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_10.jpg" style="background-image: url(/images/cars/creta/slider/gallery_10.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/creta/slider/gallery_11.jpg" style="background-image: url(/images/cars/creta/slider/gallery_11.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_12.jpg" style="background-image: url(/images/cars/creta/slider/gallery_12.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_13.jpg" style="background-image: url(/images/cars/creta/slider/gallery_13.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_14.jpg" style="background-image: url(/images/cars/creta/slider/gallery_14.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/creta/slider/gallery_15.jpg" style="background-image: url(/images/cars/creta/slider/gallery_15.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/creta/slider/gallery_16.jpg" style="background-image: url(/images/cars/creta/slider/gallery_16.jpg)"></li>
					</ul>
					<div class="gallery__indicator">
						<span class="gallery__current">01</span>
						<span class="gallery__sep">/</span>
						<span class="gallery__total">00</span>
					</div>
				</div>
				<div class="gallery__nav">
					<ul id="gallery-nav" class="gallery__nav-list">
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_1.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_2.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_3.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_4.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_5.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_6.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_7.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_8.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_9.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_10.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_11.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_12.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_13.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_14.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_15.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/creta/slider/preview/gallery_preview_16.jpg)"></li>
					</ul>
				</div>
				<div class="gallery__wrapper">
					<a href="#" download class="gallery__download">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10 9H0" stroke="black" stroke-width="2"/>
							<path d="M5 0L5 6" stroke="black" stroke-width="2"/>
							<path d="M9 3L5.6 5.55C5.24445 5.81667 4.75556 5.81667 4.4 5.55L1 3" stroke="black" stroke-width="2"/>
						</svg>
						Скачать фотографию
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')
    <script src="{{ mix('/js/creta/libs.js') }}"></script>
	<script src="{{ mix('/js/creta/gallery.js') }}"></script>
@endsection
