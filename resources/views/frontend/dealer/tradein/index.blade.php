@extends('layouts.master-dealer')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')
@section('pageDescription', 'Официальный сайт Hyundai: модели и актуальные цены, обзоры и фото автомобилей, новости, запись на тест-драйв. Спешите купить новый Hyundai!')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/dealer/css/tradein/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/placeholder.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/tradein/tradein.css') }}">
@endsection

@section('content')

<section class="banner df-main-banner">
<div class="container-fluid df-main-banner__wrap">
	<div class="row">
		<div class="col-md-12">
			<div class="df-main-banner__inner lazyload lazypreview" data-bgset="/dealer/images/tradein/banner.jpg [(max-width: 640px)] | /dealer/images/tradein/banner.jpg">
				<h1 class="df-main-banner__title">Hyundai Трейд-ин</h1>
				<div class="df-main-banner__subtitle">
					Обменяйте свой Hyundai
					<br>на новый на выгодных условиях.
				</div>
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

<div id="tradein" class="tradein">
	<div v-if="!init">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@component('components/placeholder')@endcomponent
				</div>
			</div>
		</div>
	</div>
	<template v-else>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="h3 tradein__title">Оцените свой автомобиль в 3 шага</h2>
					<tradein-menu></tradein-menu>
					<tradein-steps send-url="/"></tradein-steps>
				</div>
			</div>
		</div>
	</template>
</div>

<script>
//Тестовые данные
var carsList = [
	{
		id: 0,                    //* Number
		order: 0,                 //* Number (Для сортировки, по возрастанию)
		name: '	SOLARIS',          //* String
		profitPrice: 20000,     //Number (скидка)
		minPrice: 1750000,        //*Number (указывается на странице авто)
		maxPrice: 1850000,        //Number (опционально, на странице авто указывается минимальная цена)
		image: '/images/cars/Solaris.png',
		link: 'https://www.hyundai.ru/Solaris'
	},
	{
		id: 1,
		order: 1,
		name: 'SONATA',
		profitPrice: 820000,
		minPrice: 2750000,
		maxPrice: 5850000,
		image: '/images/cars/Sonata.png',
		link: 'https://www.hyundai.ru/Solaris'
	},
	{
		id: 2,
		order: 2,
		name: 'Новый SANTA FE',
		profitPrice: 20000,
		minPrice: 1750000,
		maxPrice: 1850000,
		image: '/images/cars/SANTA_FE.png',
		link: 'https://www.hyundai.ru/Solaris'
	},
	{
		id: 3,
		order: 3,
		name: 'Новый SANTA FE',
		profitPrice: 20000,
		minPrice: 1750000,
		image: '/images/cars/SANTA_FE.png',
		link: 'https://www.hyundai.ru/Solaris'
	},
	{
		id: 4,
		order: 4,
		name: 'Новый SANTA FE',
		profitPrice: 120000,
		minPrice: 1750000,
		maxPrice: 1850000,
		image: '/images/cars/SANTA_FE.png',
		link: 'https://www.hyundai.ru/Solaris'
	},
	
]
</script>
@endsection

@section('scripts')
	<script src="{{ mix('/dealer/js/lazypreview.js') }}"></script>
    <script src="{{ mix('/dealer/js/tradein/libs.js') }}"></script>
    <script src="{{ mix('/dealer/js/tradein/index.js') }}"></script>
@endsection
