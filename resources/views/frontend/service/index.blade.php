@extends('layouts.master-dealer')

@section('pageTitle', 'Обслуживание')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/service/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/service/service.css') }}">
@endsection

@section('content')

@component('components/plugin-map')@endcomponent

<section class="head">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="head__banner">
                    <div class="head__composition">
                        <h1 class="head__title">Обслуживание.</h1>
                        <div class="df-text-main-16px">
                            Большинство организаций, занимающихся техническим обслуживанием автомобилей подтвердят, что большей части поломок, с которыми сталкиваются владельцы автомобилей, можно избежать, придерживаясь рекомендаций производителя по регулярному обслуживанию и ремонту автомобиля. Надлежащий уход за автомобилем позволит улучшить его ходовые характеристики, снизить расход топлива и повысить безопасность.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
window.sap = '{{ $dealerData['sap'] }}';
</script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<section id="app">
				<div v-if="!init">
					@component('components/placeholder')@endcomponent
				</div>
				<service-calculator v-else></service-calculator>
			</section>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<section class="find-dealer">
				<div class="find-dealer__left"></div>
				<div class="find-dealer__right">
					<div class="find-dealer__composition">
						<h3 class="find-dealer__title">Workshop Automation</h3>
						<div class="find-dealer__text df-text-main-16px">
							Автоматизированная система обслуживания клиентов и&nbsp;контроля за&nbsp;рабочими процессами в&nbsp;дилерском центре, реализованная как мобильное приложение для планшетных компьютеров.
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

@component('components/slider-1', ['title' => 'Преимущества системы WA', 'slides' => [
    [
        'img' => '/images/service/slider-1/0.svg',
        'title' => 'Обратная связь',
        'description' => 'Интерактивный опрос при выдаче автомобиля о качестве обслуживания'
    ],
    [
        'img' => '/images/service/slider-1/1.svg',
        'title' => 'Отслеживание хода работ',
        'description' => 'Онлайн информация в клиентской зоне о статусе выполнения работ'
    ],
    [
        'img' => '/images/service/slider-1/2.svg',
        'title' => 'Всегда вовремя',
        'description' => 'Отсутствие задержек благодаря системе он-лайн оповещений о ходе выполнения работ между мастером-консультантом и механиком'
    ],
    [
        'img' => '/images/service/slider-1/3.svg',
        'title' => 'Фото и голосовая запись',
        'description' => 'Фото и аудио фиксация ваших пожеланий и состояния вашего автомобиля. Фотографии до и после ремонта'
    ],
    [
        'img' => '/images/service/slider-1/4.svg',
        'title' => 'Специальные предложения',
        'description' => 'Интерактивное отображение наших специальных предложений для вас'
    ]
]])@endcomponent

@component('components/slider-2', ['title' => 'Принципы периодического обслуживания', 'slides' => [
    [
        'img' => '/images/service/slider-2/0.png',
        'title' => 'Регулярность',
        'description' => 'Чтобы владение автомобилем приносило только положительные эмоции необходимо регулярно проводить техническое обслуживание в соответствии с регламентом завода-изготовителя.'
    ],
    [
        'img' => '/images/service/slider-2/1.png',
        'title' => 'Периодичность',
        'description' => 'При нормальных условиях эксплуатации периодическое техническое обслуживание нужно проходить каждые 15000 км или 1 раз в год в зависимости от того, что наступит раньше.'
    ],
    [
        'img' => '/images/service/slider-2/2.png',
        'title' => 'Авторизованный сервис',
        'description' => 'Невыполнение или ненадлежащее выполнение периодического технического обслуживания, в том числе прохождение технического обслуживания НЕ у Авторизованного Сервисного Партнёра Хёндэ (Hyundai), может стать причиной отказа в проведении ремонта автомобиля по гарантии.'
    ],
    [
        'img' => '/images/service/slider-2/3.png',
        'title' => 'Дополнительные работы',
        'description' => 'По результатам проверок в рамках периодического технического обслуживания Авторизованный Сервисный Партнёр Хёндэ (Hyundai) может порекомендовать проведение дополнительных работ, не входящих в регламент ТО'
    ]
]])@endcomponent

@component('components/sign-up-service')@endcomponent

<section class="disclamer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-10 offset-lg-1">
                    <div class="disclamer__center">
                        <div class="disclamer__star">
                            <svg>
                                <use xlink:href="#icon-star"></use>
                            </svg>
                        </div>
                        <div class="disclamer__text df-text-small-12px">
                            Стоимость Технического обслуживания носит исключительно информационный характер, указана на&nbsp;основании данных, предоставленных официальными дилерами Hyundai, и&nbsp;может отличаться от&nbsp;действительных цен официальных дилеров Hyundai.
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@section('scripts')
    <script src="{{ mix('/js/service/libs.js') }}"></script>
    <script src="{{ mix('/js/service/service-calculator.js') }}"></script>
    <script src="{{ mix('/js/service/service.js') }}"></script>
@endsection
