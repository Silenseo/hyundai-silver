@extends('layouts.master-dealer')

@section('pageTitle', 'H-1')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/h1/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/h1/h1.css') }}">
@endsection

@section('content')

@component('components/plugin-map')@endcomponent

<section class="nav">
    <ul class="nav__menu">
        <li class="nav__item">
            <a href="#design" class="nav__link scroll">
                Дизайн
            </a>
        </li>
        <li class="nav__item">
            <a href="#dynamics" class="nav__link scroll">
                Динамика
            </a>
        </li>
        <li class="nav__item">
            <a href="#comfort" class="nav__link scroll">
                Комфорт
            </a>
        </li>
        <li class="nav__item">
            <a href="#safety" class="nav__link scroll">
                Безопасность
            </a>
        </li>
        <li class="nav__item">
            <a href="#specs" class="nav__link scroll">
                Характеристики
            </a>
        </li>
        <li class="nav__item">
            <a target="_blank" href="{{ route('static_car16') }}/gallery" class="nav__link">
                Галерея
            </a>
        </li>
    </ul>
    <div class="nav__buttons">
        <a target="_blank" href="/test-drive/h1" class="df-button nav__button js-open-p-td">
            Тест-драйв
        </a>
        <a target="_blank" href="/configurator/car/16" class="df-button nav__button">
            Конфигуратор
        </a>
    </div>
</section>

<section class="banner section section--big lazyload lazypreview" data-bgset="/images/cars/h1/m_pics/01_title/title.jpg [(max-width: 640px)] | /images/cars/h1/pics/title.jpg">
    <div class="banner__head">
        <h1 class="banner__title">
            <span>Новый H-1.</span>
        </h1>
        <div class="banner__subtitle h3">
            <span>Инновации в каждом мгновении.</span>
        </div>
    </div>
    <div class="blue-label" style="display:none">
        <div class="blue-label__top">
            <span>от</span> <span id="price-from"></span> &#8381;
        </div>
        <hr>
        <div class="blue-label__bottom">
            В кредит — от <span id="credit-from"></span> ₽/мес
        </div>
    </div>
    <a href="#view360" class="js-next-slide banner__circle scroll"></a>
    <!-- <div class="preloader__inner"></div> -->

	<div id="hotbuttons">
		<!-- Установим активной модель. model Св-во codeName!!!!!! -->
		<hot-buttons :car-id="16" model="h-1" :buttons="[1,1,1]"></hot-buttons>
	</div>
</section>

<section id="view360" class="section">
	<view-360 title="Выбери свой H-1" car-id="16"></view-360>
</section>

<section id="design" class="design">
	<presentation-section
		title = 'Дизайн,<br/>пробуждающий<br/>эмоции.'
		background = '/images/cars/h1/pics/2_design/design_title.jpg'
		background-mobile = '/images/cars/h1/m_pics/02_design/design_title.jpg'
		:slides="[
			{
				icon: '/images/cars/h1/svg/d1.svg',
				title: 'Противотуманные фары',
				description: 'Комплектация микроавтобуса может включать противотуманные фары, которые аккуратно встроены в нижнюю часть переднего бампера.',
				background: '/images/cars/h1/pics/2_design/d1.jpg',
				zoom: 2.6,
				correct: {
					x: 100,
					y: 0
				}
			},
			{
				icon: '/images/cars/h1/svg/d1.svg',
				title: 'Фары проекционного типа',
				description: 'Фары проекционного типа прекрасно освещают дорожное полотно и обочины, делая путешествие комфортным и безопасным.',
				background: '/images/cars/h1/pics/2_design/d2.jpg',
				zoom: 4,
				correct: {
					x: 0,
					y: 0
				}
			},
			{
				icon: '/images/cars/h1/svg/d1.svg',
				title: 'Электропривод складывания зеркал',
				description: 'Наружные зеркала заднего вида с электроприводом складывания, окрашенные в цвет кузова обеспечивают хорошую видимость в любую погоду.',
				background: '/images/cars/h1/pics/2_design/d3.jpg',
				zoom: 4,
				correct: {
					x: 0,
					y: 0
				}
			},
			{
				icon: '/images/cars/h1/svg/d1.svg',
				title: 'Боковые молдинги',
				description: 'Между колесными арками топовых версий микроавтобуса установлены привлекательные боковые молдинги.',
				background: '/images/cars/h1/pics/2_design/d4.jpg',
				zoom: 4,
				correct: {
					x: 0,
					y: 0
				}
			}
		]"
	></presentation-section>
</section>


<section id="dynamics" class="section dynamics dynamics--2">
	<div class="dynamics__back lazyload lazypreview" data-bgset="/images/cars/h1/tablet/performance_1.jpg [(max-width: 640px)] | /images/cars/h1/tablet/performance_1.jpg"></div>
    <div class="dynamics__head">
        <h2 class="dynamics__title dynamics__title--small">
            <span>
                Мощь, утонченность<br/>и качество.
            </span>
        </h2>
    </div>
    <div class="d-composition">
        <div class="d-composition__icon">
            <img src="/images/cars/h1/svg/performance_3.svg">
        </div>
        <div class="d-composition__title">
            6-ступенчатая МКПП
        </div>
        <div class="d-composition__description">
            6-ступенчатая ручная коробка передач обеспечивает точное и плавное переключение передач, добавляя уверенности за рулем.
        </div>
    </div>
</section>

<section id="comfort" class="comfort">
	<presentation-section
		title = 'Элегантный<br>комфорт.'
		background = '/images/cars/h1/pics/4_comfort/comfort_title.jpg'
		background-mobile = '/images/cars/h1/m_pics/04_comfort/comfort_title.jpg'
		:slides="[
            {
                icon: '/images/cars/h1/svg/c1.svg',
                title: 'Система кондиционирования воздуха',
                description: 'Мощная система кондиционирования воздуха претерпела конструктивные изменения и теперь включает расположенные на потолке с обеих сторон отверстия воздуховодов для большего комфорта пассажиров на задних сиденьях.',
                background: '/images/cars/h1/pics/4_comfort/comfort_1.jpg',
                zoom: 2.6,
                correct: {
                    x: 0,
                    y: 0
                }
            },
            {
                icon: '/images/cars/h1/svg/c1.svg',
                title: 'Органы управления стеклоподъемниками',
                description: 'Как обычно, мы внимательны к мелочам: подлокотник водительской двери снабжен изящными встроенными кнопками для управления стеклоподъемниками и регулировки зеркал заднего вида.',
                background: '/images/cars/h1/pics/4_comfort/comfort_2.jpg',
                zoom: 1.6,
                correct: {
                    x: 250,
                    y: 0
                }
            }
        ]"
	></presentation-section>
</section>

<section id="safety" class="section safety safety--1">
    <div class="safety__head">
        <h2 class="safety__main">
            <span>
                Продуманная<br/>безопасность
            </span>
        </h2>
    </div>
    <div data-bgset="/images/cars/i30n/m_pics/safety_1.jpg [(max-width: 640px)] | /images/cars/h1/pics/5_tech/st.jpg" class="safety__back safety__back--1 lazyload lazypreview"></div>
</section>

<section class="section s-parallax safety safety--2">
    <div class="safety__head">
        <h2 class="safety__main safety__main--small safety__main--on">
            <span>
                Продуманная<br/>безопасность
            </span>
        </h2>
    </div>
    <ul class="s-parallax__list s-parallax__list--left">
        <li class="s-parallax__item s-parallax__item--50 lazyload lazypreview" data-order="1" data-bgset="/images/cars/h1/pics/5_tech/s1.jpg [(max-width: 640px)] | /images/cars/h1/pics/5_tech/s1.jpg">
            <div class="s-parallax__description s-parallax__description--black">
                <span>ESC постоянно следит за курсовой устойчивостью</span> автомобиля и сцеплением шин с дорогой
            </div>
        </li>
        <li class="s-parallax__item s-parallax__item--50 lazyload lazypreview" data-order="2" data-bgset="/images/cars/h1/pics/5_tech/s2.jpg [(max-width: 640px)] | /images/cars/h1/pics/5_tech/s2.jpg">
            <div class="s-parallax__description s-parallax__description--black">
                Большие и мощные дисковые тормоза устанавливаются <span>и на задние, и передние колеса.</span> Они обеспечивают высокий уровень тормозных характеристик.
            </div>
        </li>
    </ul>
    <ul class="s-parallax__list s-parallax__list--right">
        <li class="s-parallax__item s-parallax__item--right s-parallax__item--100 lazyload lazypreview" data-order="4" data-bgset="/images/cars/h1/pics/5_tech/s3.jpg [(max-width: 640px)] | /images/cars/h1/pics/5_tech/s3.jpg">
            <div class="s-parallax__description s-parallax__description--black">
               Узкие участки на центральных улицах городов или проселочных дорогах не доставят проблем водителю H-1. Несмотря на более чем пятиметровую длину, <span>радиус поворота автомобиля не&nbsp;превышает 5,6&nbsp;м.</span>
            </div>
        </li>
    </ul>
</section>

<section id="specs">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<specs-section car-id="16" model-type="Микроавтобус" number-of-seats="8" engine="Дизельный" drive="Задний" gear-box="Механическая / Автоматическая"></specs-section>
				<?php if(strlen($disclaimer) > 0) :?>
				<div class="specs" style="padding-top: 0px;">
				    <div class="section__center">
				        <div class="dsclmr df-text-small-12px">
                            <div class="dsclmr__icon"><svg width="2" height="9" viewBox="0 0 2 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 6.75H0V9H2V6.75Z" fill="white"></path> <path d="M0.133301 0H1.86663L1.5333 5.55H0.466634L0.133301 0Z" fill="white"></path></svg></div>
                            <div class="dsclmr__body">{{ $disclaimer }}</div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>

<div id="tdpopup">
	<sign-up-test-drive-form-popup v-if="isVisible" page="isModelPage"></sign-up-test-drive-form-popup>
</div>

@endsection

@section('scripts')
	<script src="{{ mix('/js/lazypreview.js') }}"></script>
    <script src="{{ mix('/js/h1/libs.js') }}"></script>
	<script src="{{ mix('/js/h1/h1.js') }}"></script>
	<script src="{{ mix('/js/h1/main.js') }}"></script>
@endsection
