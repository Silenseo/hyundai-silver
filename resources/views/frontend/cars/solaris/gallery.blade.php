@extends('layouts.master-dealer')

@section('pageTitle', 'Solaris')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/solaris/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/solaris/solaris.css') }}">
@endsection

@section('content')
<section class="nav">
    <ul class="nav__menu">
        <li class="nav__item">
            <a href="{{ route('static_dealerapi_car23', null, false) }}#design" class="nav__link scroll">
                Дизайн
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_dealerapi_car23', null, false) }}#dynamics" class="nav__link scroll">
                Динамика
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_dealerapi_car23', null, false) }}#comfort" class="nav__link scroll">
                Комфорт
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_dealerapi_car23', null, false) }}#safety" class="nav__link scroll">
                Безопасность
            </a>
        </li>
        <li class="nav__item">
            <a href="{{ route('static_dealerapi_car23', null, false) }}#specs" class="nav__link scroll">
                Характеристики
            </a>
        </li>
        <li class="nav__item">
            <a target="_blank" href="{{ route('static_dealerapi_car23', null, false) }}/gallery" class="nav__link active">
                Галерея
            </a>
        </li>
    </ul>
    <div class="nav__buttons">
        <a target="_blank" href="/test-drive/Solaris" class="df-button nav__button">
            Тест-драйв
        </a>
        <a target="_blank" href="/configurator/car/23" class="df-button nav__button">
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
				<div class="gallery__wrapper">
					<ul id="gallery" class="gallery__list">
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/1.jpg" style="background-image: url(/images/cars/Solaris/slider/1.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/2.jpg" style="background-image: url(/images/cars/Solaris/slider/2.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/3.jpg" style="background-image: url(/images/cars/Solaris/slider/3.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/4.jpg" style="background-image: url(/images/cars/Solaris/slider/4.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/5.jpg" style="background-image: url(/images/cars/Solaris/slider/5.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/Solaris/slider/6.jpg" style="background-image: url(/images/cars/Solaris/slider/6.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/7.jpg" style="background-image: url(/images/cars/Solaris/slider/7.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/8.jpg" style="background-image: url(/images/cars/Solaris/slider/8.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/9.jpg" style="background-image: url(/images/cars/Solaris/slider/9.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/10.jpg" style="background-image: url(/images/cars/Solaris/slider/10.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/Solaris/slider/11.jpg" style="background-image: url(/images/cars/Solaris/slider/11.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/12.jpg" style="background-image: url(/images/cars/Solaris/slider/12.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/13.jpg" style="background-image: url(/images/cars/Solaris/slider/13.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/14.jpg" style="background-image: url(/images/cars/Solaris/slider/14.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/15.jpg" style="background-image: url(/images/cars/Solaris/slider/15.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/Solaris/slider/16.jpg" style="background-image: url(/images/cars/Solaris/slider/16.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/17.jpg" style="background-image: url(/images/cars/Solaris/slider/17.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/18.jpg" style="background-image: url(/images/cars/Solaris/slider/18.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/19.jpg" style="background-image: url(/images/cars/Solaris/slider/19.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/20.jpg" style="background-image: url(/images/cars/Solaris/slider/20.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/Solaris/slider/21.jpg" style="background-image: url(/images/cars/Solaris/slider/21.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/22.jpg" style="background-image: url(/images/cars/Solaris/slider/22.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/23.jpg" style="background-image: url(/images/cars/Solaris/slider/23.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/24.jpg" style="background-image: url(/images/cars/Solaris/slider/24.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/25.jpg" style="background-image: url(/images/cars/Solaris/slider/25.jpg)"></li>
                        <li class="gallery__item" data-image="/images/cars/Solaris/slider/26.jpg" style="background-image: url(/images/cars/Solaris/slider/26.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/27.jpg" style="background-image: url(/images/cars/Solaris/slider/27.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/28.jpg" style="background-image: url(/images/cars/Solaris/slider/28.jpg)"></li>
						<li class="gallery__item" data-image="/images/cars/Solaris/slider/29.jpg" style="background-image: url(/images/cars/Solaris/slider/29.jpg)"></li>
					</ul>
					<div class="gallery__indicator">
						<span class="gallery__current">01</span>
						<span class="gallery__sep">/</span>
						<span class="gallery__total">00</span>
					</div>
				</div>
				<div class="gallery__nav">
					<ul id="gallery-nav" class="gallery__nav-list">
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/1.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/2.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/3.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/4.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/5.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/6.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/7.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/8.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/9.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/10.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/11.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/12.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/13.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/14.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/15.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/16.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/17.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/18.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/19.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/20.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/21.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/22.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/23.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/24.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/25.jpg)"></li>
                        <li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/26.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/27.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/28.jpg)"></li>
						<li class="gallery__nav-item" style="background-image: url(/images/cars/Solaris/slider/preview/29.jpg)"></li>
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
    <script src="{{ mix('/js/solaris/libs.js') }}"></script>
	<script src="{{ mix('/js/solaris/gallery.js') }}"></script>
@endsection
