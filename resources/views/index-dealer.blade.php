@extends('layouts.master-dealer')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')
@section('pageDescription', 'Официальный сайт Hyundai: модели и актуальные цены, обзоры и фото автомобилей, новости, запись на тест-драйв. Спешите купить новый Hyundai!')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/dealer/css/index/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/index/index.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/index/index-dealer.css') }}">
@endsection

@section('content')
    <section class="slider lazyload lazypreview" data-bgset="/images/index/fon.jpg">
        <div class="container-fluid slider__wrap">
            <div class="row">
                <div class="col-md-12">
					<div class="slider__wrap">
						<ul class="slider__body js-main-slider owl-carousel">
							<li class="slider__item">
								<a id="start-link" href="/start" class="slider__link">
									<div class="slider__video"></div>
									<div class="blue-panel">
										<div class="blue-panel__inner">
											<div class="blue-panel__more" style="display: block; color: #fff;">
												<span>Предодобрение</span>
												<div>
													<span>онлайн</span>
													<svg style="display: inline-block;">
														<use xlink:href="#arrow-link"></use>
													</svg>
												</div>
											</div>
										</div>
									</div>
								</a>
							</li>
							@foreach($banners as $banner)
							<li class="slider__item lazyload lazypreview" data-bgset="{{ $banner->getImageMobileUrl() }} [(max-width: 640px)] | {{ $banner->getImageUrl() }}">
								<a class="slider__link" href="{{ $banner->link }}" {{ $banner->target == 1 || strpos($banner->link, '"//') !== false ? 'target="_blank"' : '' }} aria-label="{{ $banner->title }}">
									@if($banner->font_color == 0)
									<div class="slider__inner">
										<h2 class="slider__title">{{ $banner->title }}</h2>
										<div class="slider__subtitle df-banner-subline">{{ $banner->subtitle }}</div>
									</div>
									@else
									<div class="slider__inner">
										<h2 class="slider__title" style="color: #000;">{{ $banner->title }}</h2>
										<div class="slider__subtitle df-banner-subline" style="color: #000;">{{ $banner->subtitle }}</div>
									</div>
									@endif
									@if($banner->blue_show == 1)
									<div class="blue-panel">
										<div class="blue-panel__inner">
											@if(strlen($banner->blue_row1) > 0)
												@if($banner->row1_type == 3)
													<div class="blue-panel__more">
														{{ $banner->blue_row1 }}
														<svg>
															<use xlink:href="#arrow-link"></use>
														</svg>
													</div>
												@else
													<div>
														{{ $banner->blue_row1 }}
														<?php
														switch($banner->row1_type) {
															case 1: { echo '&nbsp;₽'; break; }
															case 2: { echo '&nbsp;₽/мес.'; break; }
															//case 3: { echo '&nbsp;>'; break; }
														};
														?>
													</div>
												@endif
											@endif

											@if(strlen($banner->blue_row2) > 0)
												@if($banner->row2_type == 3)
													<div class="blue-panel__more">
														{{ $banner->blue_row2 }}
														<svg>
															<use xlink:href="#arrow-link"></use>
														</svg>
													</div>
												@else
													<div>
														{{ $banner->blue_row2 }}
														<?php
														switch($banner->row2_type) {
															case 1: { echo '&nbsp;₽'; break; }
															case 2: { echo '&nbsp;₽/мес.'; break; }
															//case 3: { echo '&nbsp;>'; break; }
														};
														?>
													</div>
												@endif
											@endif

											@if(strlen($banner->blue_row3) > 0)
												@if($banner->row3_type == 3)
													<div class="blue-panel__more">
														{{ $banner->blue_row3 }}
														<svg>
															<use xlink:href="#arrow-link"></use>
														</svg>
													</div>
												@else
													<div>
														{{ $banner->blue_row3 }}
														<?php
														switch($banner->row3_type) {
															case 1: { echo '&nbsp;₽'; break; }
															case 2: { echo '&nbsp;₽/мес.'; break; }
															//case 3: { echo '&nbsp;>'; break; }
														};
														?>
													</div>
												@endif
											@endif

											{{--
											<div>
												от 1 999 000 ₽
											</div>
											<div>
												КАСКО в подарок
											</div>
											<div class="blue-panel__more">
												Подробнее
												<svg>
													<use xlink:href="#arrow-link"></use>
												</svg>
											</div>
											--}}
										</div>
									</div>
									@endif
								</a>
							</li>
							@endforeach
						</ul>
						<div id="hotbuttons">
							<!--
							Входные параметры:
							*from-hour: Number (Час начала работы для звонка клиенту)
							*to-hour: Number (Час окончания работы + 55 минут для звонка клиенту)
							*type: Number (Тип окна обратного звонка: 0 - без выбора дилерского центра, 1 - с выбором)
							centers-list: Array (Список дилерских центров)
								{
									*name: 'Первый',
									address: 'Москва, улица Новый Арбат д. 21, ст. 1',
									coordinates: [58.578123, 49.607352],
									phones: ['777-777','888-888'],
									stations: ['Смоленская (400 м)', 'Курская (400 м)'],
									time: 'ежедневно, с 10:00 до 22:00'
								}
							*url-call-back: String (URL для отправки формы обратного звонка)
							*url-ask-question: String (URL для отправки формы задать вопрос)

							* - обязательные параметры
							-->

							<hot-buttons-dealer :from-hour="10" :to-hour="18" :type="1" :centers-list="[
							{
								name: 'Первый'
							},
							{
								name: 'Второй'
							}
						]" url-call-back="/" url-ask-question="/"></hot-buttons-dealer>
						</div>
					</div>
                </div>
            </div>
        </div>
    </section>

	<section class="cards">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="cards__list">
						<li class="cards__card">
							<div class="cards__circle">
								<img src="/images/index/img1.png" alt="car">
							</div>
							<div class="cards__icon">
								<img src="/images/index/icon1.png" alt="car">
							</div>
							<div class="cards__title">Купи новый автомобиль</div>
							<div class="cards__text">400 автомобилей в наличии</div>
						</li>
						<li class="cards__card">
							<div class="cards__circle">
								<img src="/images/index/img2.png" alt="car">
							</div>
							<div class="cards__icon">
								<img src="/images/index/icon2.png" alt="car">
							</div>
							<div class="cards__title">Автомобили с пробегом</div>
							<div class="cards__text">500 автомобилей в наличии</div>
						</li>
						<li class="cards__card">
							<div class="cards__circle">
								<img src="/images/index/img3.png" alt="car">
							</div>
							<div class="cards__icon">
								<img src="/images/index/icon3.png" alt="car">
							</div>
							<div class="cards__title">Обменяй свой автомобиль</div>
							<div class="cards__text">По программе Трейд-Ин</div>
						</li>
						<li class="cards__card">
							<div class="cards__circle">
								<img src="/images/index/img4.png" alt="car">
							</div>
							<div class="cards__icon">
								<img src="/images/index/icon4.png" alt="car">
							</div>
							<div class="cards__title">Записаться на сервис</div>
							<div class="cards__text">Техническое обслуживание</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section id="calc" style="background-color: #F8F8F8;">
		<div v-if="!init">
			@component('components/placeholder')@endcomponent
		</div>
		<!--
		Входные параметры:
		*dealer-tel: String (Телефон дилера)

		* - обязательные параметры
		-->
		<start-calc v-else dealer-tel="8-800-200-77-77"></start-calc>
	</section>

	<section class="service-book lazyload lazypreview" data-bgset="/images/index/service__book.jpg">
		<div class="container">
			<div class="row">
				<div class="offset-lg-1 col-lg-4 col-md-4">
					<div class="service-book__inner">
						<h2 class="h3 service-book__title">Электронная<br>сервисная книжка<br>в&nbsp;Мире Хёндэ</h2>
						<div class="service-book__text">Это защищенная база данных, которая хранит информацию о&nbsp;вашем Hyundai.</div>
						<a href="https://mir.hyundai.ru/login" class="df-button service-book__button">Зарегистрироваться</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="dealer-info">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="dealer-info__inner">
						<div class="dealer-info__img lazyload lazypreview" data-bgset="/images/index/dealer-info.jpg"></div>
						<div class="dealer-info__description">
							<h2 class="h3 dealer-info__title">АВИЛОН&nbsp;&mdash; официальный дилер Hyundai в&nbsp;России</h2>
							<div class="dealer-info__text">
								АВИЛОН&nbsp;&mdash; официальный дилер Hyundai в&nbsp;Москве. В&nbsp;нашем автосалоне&nbsp;Вы можете изучить, пройти тест-драйв и&nbsp;купить Hyundai 2018 и&nbsp;2019 года выпуска любой модели и&nbsp;комплектации. Опытные специалисты помогут выбрать модель, отвечающую всем Вашим требованиям.
							</div>
							<a href="#" class="df-iconed-link dealer-info__about">
								О компании
								<svg>
									<use xlink:href="#arrow-link"></use>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="about-hyundai">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="about-hyundai__inner">
						<h3 class="about-hyundai__title">Hyundai&nbsp;&mdash; новое мышление, новые возможности</h3>
						<div class="about-hyundai__left">
							<p>
								Основополагающая идея Hyundai&nbsp;&mdash; непрерывность прогресса и&nbsp;производство новых, всё более качественных, практичных и&nbsp;функциональных автомобилей. Этот принцип нашёл отражение в&nbsp;концепте &laquo;Современный премиум&raquo; и&nbsp;воплощается в&nbsp;каждой модели бренда.
							</p>
							<p>
								В&nbsp;настоящее время автомобили южнокорейского производителя являются одними из&nbsp;самых популярных в&nbsp;России. Этому способствует целый ряд факторов: превосходное качество сборки, высокая надёжность, эффектный дизайн и&nbsp;приемлемая цена. Модельный ряд Hyundai удовлетворяет требованиям самых взыскательных покупателей.
							</p>
						</div>
						<div class="about-hyundai__right">
							<p>
								Для постоянных клиентов действует выгодная дисконтная программа. Также мы&nbsp;регулярно запускаем специальные предложения и&nbsp;акции, благодаря которым&nbsp;Вы сможете максимально выгодно купить новый Hyundai в&nbsp;Москве.
							</p>
							<p>
								Благодаря безукоризненной работе официальный дилер Hyundai АВИЛОН уже многие годы занимает одну из&nbsp;ведущих позиций на&nbsp;автомобильном рынке Москвы. Обратитесь к&nbsp;менеджерами автосалона, чтобы уточнить комплектации и&nbsp;цены на&nbsp;Hyundai в&nbsp;наличии. Консультацию можно получить по&nbsp;телефону или через онлайн-чат на&nbsp;сайте. Кроме того, Вы&nbsp;можете заказать обратный звонок на&nbsp;удобное время или приехать непосредственно в&nbsp;дилерский центр. Мы&nbsp;ждём Вас ежедневно с&nbsp;09-00 до&nbsp;21-40. А&nbsp;сервисный центр работает для Вас круглосуточно!
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	<script src="{{ mix('/dealer/js/lazypreview.js') }}"></script>
    <script src="{{ mix('/dealer/js/index/libs.js') }}"></script>
    <script src="{{ mix('/dealer/js/index/index.js') }}"></script>
    <script src="{{ mix('/dealer/js/index/index-dealer.js') }}"></script>
@endsection
