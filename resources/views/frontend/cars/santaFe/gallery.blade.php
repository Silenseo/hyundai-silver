﻿@extends('layouts.master-dealer')

@section('pageTitle', 'SantaFe')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/santaFe/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/santaFe/santa-fe.css') }}">
@endsection

@section('content')
<section class="nav">
    <ul class="nav__menu">
        <li class="nav__item">
            <a href="{{ route('static_car25') }}#design" class="nav__link scroll">
                Дизайн
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car25') }}#dynamics" class="nav__link scroll">
                Динамика
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car25') }}#comfort" class="nav__link scroll">
                Комфорт
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car25') }}#safety" class="nav__link scroll">
                Безопасность
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_car25') }}#specs" class="nav__link scroll">
                Характеристики
            </a>
        </li>
        <li class="nav__item">
            <a target="_blank" href="{{ route('static_car25') }}/gallery" class="nav__link active">
                Галерея
            </a>
        </li>
    </ul>
    <div class="nav__buttons">
        <a target="_blank" href="/test-drive" class="df-button nav__button">
            Тест-драйв
        </a>
        <a target="_blank" href="/configurator/car/25" class="df-button nav__button">
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
                <h1 class="h2 mb-5 text-center">Галерея новой SANTA FE</h1>
				<div class="gallery__wrapper">
					<ul id="gallery" class="gallery__list">
						<li class="gallery__item" data-image="/images/santaFe/pics/slider/1.jpg" style="background-image: url(/images/santaFe/pics/slider/1.jpg)"></li>
						<li class="gallery__item" data-image="/images/santaFe/pics/slider/2.jpg" style="background-image: url(/images/santaFe/pics/slider/2.jpg)"></li>
						<li class="gallery__item" data-image="/images/santaFe/pics/slider/3.jpg" style="background-image: url(/images/santaFe/pics/slider/3.jpg)"></li>
						<li class="gallery__item" data-image="/images/santaFe/pics/slider/4.jpg" style="background-image: url(/images/santaFe/pics/slider/4.jpg)"></li>
						<li class="gallery__item" data-image="/images/santaFe/pics/slider/5.jpg" style="background-image: url(/images/santaFe/pics/slider/5.jpg)"></li>
					</ul>
					<div class="gallery__indicator">
						<span class="gallery__current">01</span>
						<span class="gallery__sep">/</span>
						<span class="gallery__total">00</span>
					</div>
				</div>
				<div class="gallery__nav">
					<ul id="gallery-nav" class="gallery__nav-list">
						<li class="gallery__nav-item" style="background-image: url(/images/santaFe/pics/slider/1.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/santaFe/pics/slider/2.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/santaFe/pics/slider/3.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/santaFe/pics/slider/4.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/santaFe/pics/slider/5.jpg)"></li>
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
    <script src="{{ mix('/js/santaFe/libs.js') }}"></script>
	<script src="{{ mix('/js/santaFe/gallery.js') }}"></script>
@endsection
