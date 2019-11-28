@extends('layouts.master')

@section('pageTitle', 'Совершенство передвижений')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/brand/p-mobility/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/brand/p-mobility/index.css') }}">
@endsection

@section('content')

<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner__inner">
					
				</div>
			</div>
		</div>
	</div>
</section>

<section class="intro">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="intro__inner">
					<div class="intro__left df-slideUp">
						<div class="intro__year">2019</div>
						<h1 class="intro__title">
							Совершенство
							<br>передвижений
						</h1>
						<div class="intro__subtitle">
							Будущее автомобилестроения
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="future scrollmagic">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="future__inner">
					<div class="future__graph">
						<div class="future__back df-back">
							<div class="df-back__wrap">
								<div class="df-back__img js-set-color" data-bg="/images/brand/p-mobility/img/1-1.jpg"></div>
							</div>
						</div>
						<div class="future__wrapper">
							<div class="future__img df-img">
								<div class="future__parallax df-img__parallax parallax">
									<div class="df-img__wrap">
										<div class="df-img__img js-set-color" data-bg="/images/brand/p-mobility/img/1.jpg"></div>
									</div>
								</div>
							</div>
							<div class="future__description df-description">
								<h2 class="h1 df-title future__title">
									Будущее дизайна
								</h2>
								<div class="df-lead-text-22px df-text future__text">
									При разработке дизайна автомобилей Hyundai 
									мы&nbsp;опираемся на&nbsp;принцип &laquo;чувственная спортивность&raquo;. Он&nbsp;полностью раскрывает нашу философию дизайна и&nbsp;опирается на&nbsp;эмоциональные ценности людей в&nbsp;гармонии со&nbsp;строгим чувством пропорции, архитектуры, стиля и&nbsp;технологии.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="sport">
	<div class="container">
		<div class="row">
			<div class="offset-lg-1 col-xl-10 col-lg-11">
				<div class="sport__inner">
					<div class="sport__left">
						<h2 class="sport__m-main-title">
							Чувственная
							<br>спортивность
						</h2>
						<ul class="sport__list">
							<li class="sport__item sport__item--1">
								<div class="sport__title"><span>1.&nbsp;&nbsp;</span>Архитектура</div>
								<div class="sport__text">
									Инновационные проекты, которые стирают границы между формой и&nbsp;содержанием
								</div>
							</li>
							<li class="sport__item sport__item--2">
								<div class="sport__title"><span>2.&nbsp;&nbsp;</span>Пропорции</div>
								<div class="sport__text">
									Индивидуальность автомобиля, выраженная через его пропорции
								</div>
							</li>
							<li class="sport__item sport__item--main">
								<h2 class="sport__main-title">
									Чувственная
									<br>спортивность
								</h2>
							</li>
							<li class="sport__item sport__item--3">
								<div class="sport__title"><span>3.&nbsp;&nbsp;</span>Стиль</div>
								<div class="sport__text">
									Гармония, реализованная в&nbsp;напряжении между чистым объемом и&nbsp;четкими линиями
								</div>
							</li>
							<li class="sport__item sport__item--4">
								<div class="sport__title"><span>4.&nbsp;&nbsp;</span>Технологии</div>
								<div class="sport__text">
									Сочетание современных технологий и&nbsp;разработок завтрашнего дня
								</div>
							</li>
						</ul>
					</div>
					<div class="sport__right">
						<div class="sport__img">
							<div class="sport__mask"></div>
							<img data-src="/images/brand/p-mobility/img/2.jpg" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="value">
	<div class="value__img">
		<img data-src="/images/brand/p-mobility/img/value.png" alt="">
	</div>
	<div class="container">
		<div class="row">
			<div class="offset-lg-1 col-lg-10">
				<div class="value__inner">
					<div class="value__composition df-description">
						<h2 class="value__title">Новая ценность</h2>
						<div class="value__description df-lead-text-22px">
							Особенность концепции Modern Premium&nbsp;&mdash; использование 
							в&nbsp;конструкции и&nbsp;дизайне автомобилей Hyundai решений, которые 
							ранее использовались только в&nbsp;автомобилях премиум-сегмента.
						</div>
					</div>
					<div class="value__logo">
						<img src="/images/brand/p-mobility/img/automessen-2019-geneva.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="n-power">
	<div class="container">
		<div class="row">
			<div class="offset-xl-1 col-xl-10">
				<div class="n-power__inner">
					<div class="n-power__wrap df-description">
						<div class="n-power__logo">
							<img data-src="/images/brand/p-mobility/img/N.png" alt="N">
						</div>
						<h2 class="h1 n-power__title">N — на пределе мощности</h2>
						<div class="n-power__subtitle df-lead-text-22px">
							Суббренд N&nbsp;&mdash; это линейка спортивных автомобилей Hyundai, в&nbsp;основе которого лежат самые современные технологии. Наша главная цель&nbsp;&mdash; создать автомобиль, который сочетает в&nbsp;себе удобство и&nbsp;лучшие качества спорткара.
						</div>
					</div>
					<div class="n-power__main-img df-description">
						<img data-src="/images/brand/p-mobility/img/car.png" alt="i30N">
					</div>
					<ul class="n-power__list owl-carousel js-carousel df-description">
						<li class="n-power__item">
							<div class="n-power__img" style="background-image: url(/images/brand/p-mobility/img/m2.jpg);"></div>
							<div class="n-power__description h4">
								Агресивные воздухазаборники
							</div>
							<div class="n-power__text">
								Спроектированы специально для улучшения аэродинамики и&nbsp;охлаждения тормозов.
							</div>
						</li>
						<li class="n-power__item">
							<div class="n-power__img" style="background-image: url(/images/brand/p-mobility/img/m3.jpg);"></div>
							<div class="n-power__description h4">
								Электронно-управляемая подвеска
							</div>
							<div class="n-power__text">
								Регулирует работу амортизаторов
								в&nbsp;зависимости от&nbsp;режима движения.
							</div>
						</li>
						<li class="n-power__item">
							<div class="n-power__img" style="background-image: url(/images/brand/p-mobility/img/m1.jpg);"></div>
							<div class="n-power__description h4">
								N не даст переутомиться —
							</div>
							<div class="n-power__text">
								Система слежения за&nbsp;состоянием за&nbsp;водителя сообщит что нужно отдохнуть.
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="brand">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="brand__inner">
					<h2 class="brand__title">Бренд N</h2>
					<div class="brand__subtitle df-lead-text-22px">
						Ходовые качества моделей бренда оттачиваются на&nbsp;Нюрбургринге, одной из&nbsp;самых сложных, требовательных и&nbsp;опасных трасс мира, где располагается собственный Центр испытаний Hyundai.
					</div>
					<div class="brand__line">
						<div class="avards">
							<div class="avards__img">
								<img src="/images/brand/p-mobility/img/avards.png" alt="">
							</div>
							<h4 class="avards__title">Бензиновый турбонаддувной двигатель Lambda с&nbsp;рабочим объемом 3.3&nbsp;л.</h4>
							<div class="avards__text df-text-main-16px">
								Models: Genesis EQ900, G80, and G70
							</div>
						</div>
						<div class="brand__engine">
							<img data-src="/images/brand/p-mobility/img/engine.png" alt="">
						</div>
					</div>
					<div class="brand__img">
						<img data-src="/images/brand/p-mobility/img/cardan.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="satisfaction scrollmagic">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="satisfaction__inner">
					<div class="best">
						<div class="best__title df-slideUp">100<sup>%</sup></div>
						<ul class="best__stars">
							<li class="best__star">
								<svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.5 0L14.7446 7.03423L22.4371 7.9463L16.7498 13.2058L18.2595 20.8037L11.5 17.02L4.74047 20.8037L6.25017 13.2058L0.56285 7.9463L8.25543 7.03423L11.5 0Z" fill="#E4DCD3"/>
								</svg>
							</li>
							<li class="best__star">
								<svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.5 0L14.7446 7.03423L22.4371 7.9463L16.7498 13.2058L18.2595 20.8037L11.5 17.02L4.74047 20.8037L6.25017 13.2058L0.56285 7.9463L8.25543 7.03423L11.5 0Z" fill="#E4DCD3"/>
								</svg>
							</li>
							<li class="best__star">
								<svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.5 0L14.7446 7.03423L22.4371 7.9463L16.7498 13.2058L18.2595 20.8037L11.5 17.02L4.74047 20.8037L6.25017 13.2058L0.56285 7.9463L8.25543 7.03423L11.5 0Z" fill="#E4DCD3"/>
								</svg>
							</li>
							<li class="best__star">
								<svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.5 0L14.7446 7.03423L22.4371 7.9463L16.7498 13.2058L18.2595 20.8037L11.5 17.02L4.74047 20.8037L6.25017 13.2058L0.56285 7.9463L8.25543 7.03423L11.5 0Z" fill="#E4DCD3"/>
								</svg>
							</li>
							<li class="best__star">
								<svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.5 0L14.7446 7.03423L22.4371 7.9463L16.7498 13.2058L18.2595 20.8037L11.5 17.02L4.74047 20.8037L6.25017 13.2058L0.56285 7.9463L8.25543 7.03423L11.5 0Z" fill="#E4DCD3"/>
								</svg>
							</li>
						</ul>
						<div class="best__note df-slideUp">
							Удовлетворённость потребителей согласно исследованиям индекса качества услуг 
						</div>
					</div>
					<div class="satisfaction__graph">
						<div class="satisfaction__back df-back">
							<div class="df-back__wrap">
								<div class="df-back__img js-set-color" data-bg="/images/brand/p-mobility/img/4-4.jpg"></div>
							</div>
						</div>
						<div class="satisfaction__wrapper">
							<div class="satisfaction__img df-img">
								<div class="satisfaction__parallax df-img__parallax parallax">
									<div class="df-img__wrap">
										<div class="df-img__img js-set-color" data-bg="/images/brand/p-mobility/img/4.jpg"></div>
									</div>
								</div>
							</div>
							<div class="satisfaction__description df-description">
								<h2 class="h1 df-title satisfaction__title">
									Удовлетворенность
									<br>клиентов
								</h2>
								<div class="df-lead-text-22px df-text satisfaction__text">
									Новое пространство, создаваемое на&nbsp;основе автомобилей Hyundai, должно выйти за&nbsp;привычные рамки производительности, дизайна, сервиса и&nbsp;цены, чтобы обеспечить максимальный уровень удовлетворенности клиентов.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="service scrollmagic">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="service__inner">
					<div class="power">
						<div class="power__number">1</div>
						<svg width="128" height="99" viewBox="0 0 128 99" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M57.5975 81.5255V85.367C57.5975 85.367 15.2341 79.8181 15.2341 37.3481C15.2341 31.4791 16.5146 22.4088 20.6763 14.1923C20.6763 14.1923 17.3683 23.0491 17.3683 37.3481C17.475 51.647 27.7191 75.4431 57.5975 81.5255Z" fill="#E4DCD3"/>
							
							<g class="power__left">
								<path d="M27.3992 0C27.3992 0 30.0669 4.26835 27.6126 9.7105C25.1583 15.1526 20.2497 15.8996 20.2497 15.8996L27.3992 0Z" fill="#E4DCD3"/>
								<path d="M20.2496 15.8996C20.2496 15.8996 17.5819 11.6313 20.0362 6.18911C22.4905 0.746962 27.3991 0 27.3991 0L20.2496 15.8996Z" fill="#E4DCD3"/>
								<path d="M11.392 4.16138C11.392 4.16138 16.514 6.61568 17.4744 13.2316C18.4348 19.8476 14.2732 23.6891 14.2732 23.6891L11.392 4.16138Z" fill="#E4DCD3"/>
								<path d="M14.2732 23.6892C14.2732 23.6892 9.1512 21.2349 8.19082 14.619C7.23044 8.00301 11.3921 4.1615 11.3921 4.1615L14.2732 23.6892Z" fill="#E4DCD3"/>
								<path d="M3.70978 18.6741C3.70978 18.6741 9.25863 19.6345 12.0331 25.6101C14.9142 31.6925 11.9264 36.4944 11.9264 36.4944L3.70978 18.6741Z" fill="#E4DCD3"/>
								<path d="M11.9262 36.4944C11.9262 36.4944 6.37736 35.5341 3.60293 29.5584C0.828505 23.476 3.81635 18.6741 3.81635 18.6741L11.9262 36.4944Z" fill="#E4DCD3"/>
								<path d="M0.294922 34.6803C0.294922 34.6803 6.48403 33.9334 11.2859 39.4822C16.0878 45.0311 14.3805 51.0068 14.3805 51.0068L0.294922 34.6803Z" fill="#E4DCD3"/>
								<path d="M14.3804 51.0067C14.3804 51.0067 8.19132 51.7537 3.38943 46.2048C-1.41246 40.656 0.294875 34.6803 0.294875 34.6803L14.3804 51.0067Z" fill="#E4DCD3"/>
								<path d="M0.934753 52.2873C0.934753 52.2873 6.3769 49.6196 12.6727 53.141C18.8618 56.7691 19.2887 62.8515 19.2887 62.8515L0.934753 52.2873Z" fill="#E4DCD3"/>
								<path d="M19.2888 62.8515C19.2888 62.8515 13.8467 65.5192 7.55088 61.9979C1.36177 58.3698 0.934937 52.2874 0.934937 52.2874L19.2888 62.8515Z" fill="#E4DCD3"/>
								<path d="M5.41669 69.254C5.41669 69.254 10.2186 64.5588 17.9016 66.1595C25.5846 67.7601 28.1457 73.9492 28.1457 73.9492L5.41669 69.254Z" fill="#E4DCD3"/>
								<path d="M28.1454 74.056C28.1454 74.056 23.3435 78.7512 15.6605 77.1506C7.97745 75.5499 5.41644 69.3608 5.41644 69.3608L28.1454 74.056Z" fill="#E4DCD3"/>
								<path d="M16.5148 83.873C16.5148 83.873 20.1429 77.8973 28.3595 77.4705C36.5761 77.0437 40.8444 82.6992 40.8444 82.6992L16.5148 83.873Z" fill="#E4DCD3"/>
								<path d="M40.9509 82.5925C40.9509 82.5925 37.3228 88.5682 29.1063 88.9951C20.8897 89.4219 16.6213 83.7663 16.6213 83.7663L40.9509 82.5925Z" fill="#E4DCD3"/>
								<path d="M32.2012 96.4647C32.2012 96.4647 33.8019 89.3152 41.805 86.1139C49.8082 82.9127 55.8906 87.0743 55.8906 87.0743L32.2012 96.4647Z" fill="#E4DCD3"/>
								<path d="M55.8906 87.0742C55.8906 87.0742 54.29 94.2237 46.2868 97.425C38.2837 100.626 32.2013 96.4646 32.2013 96.4646L55.8906 87.0742Z" fill="#E4DCD3"/>
							</g>
							<g class="power__right">
								<path d="M100.601 0C100.601 0 97.9334 4.26835 100.388 9.7105C102.842 15.1526 107.751 15.8996 107.751 15.8996L100.601 0Z" fill="#E4DCD3"/>
								<path d="M107.751 15.8996C107.751 15.8996 110.418 11.6313 107.964 6.18911C105.51 0.746962 100.601 0 100.601 0L107.751 15.8996Z" fill="#E4DCD3"/>
								<path d="M116.607 4.1615C116.607 4.1615 111.485 6.6158 110.525 13.2317C109.565 19.8477 113.726 23.6892 113.726 23.6892L116.607 4.1615Z" fill="#E4DCD3"/>
								<path d="M113.726 23.6891C113.726 23.6891 118.848 21.2348 119.809 14.6188C120.769 8.00289 116.607 4.16138 116.607 4.16138L113.726 23.6891Z" fill="#E4DCD3"/>
								<path d="M124.29 18.6741C124.29 18.6741 118.741 19.6345 115.967 25.6101C113.193 31.6925 116.18 36.4944 116.18 36.4944L124.29 18.6741Z" fill="#E4DCD3"/>
								<path d="M116.074 36.4944C116.074 36.4944 121.623 35.5341 124.397 29.5584C127.171 23.476 124.184 18.6741 124.184 18.6741L116.074 36.4944Z" fill="#E4DCD3"/>
								<path d="M127.705 34.6803C127.705 34.6803 121.516 33.9334 116.714 39.4822C111.912 45.0311 113.62 51.0068 113.62 51.0068L127.705 34.6803Z" fill="#E4DCD3"/>
								<path d="M113.62 51.0067C113.62 51.0067 119.809 51.7537 124.611 46.2048C129.412 40.656 127.705 34.6803 127.705 34.6803L113.62 51.0067Z" fill="#E4DCD3"/>
								<path d="M127.064 52.2873C127.064 52.2873 121.622 49.6196 115.327 53.141C109.137 56.7691 108.711 62.8515 108.711 62.8515L127.064 52.2873Z" fill="#E4DCD3"/>
								<path d="M108.71 62.8515C108.71 62.8515 114.152 65.5192 120.448 61.9979C126.637 58.3698 127.064 52.2874 127.064 52.2874L108.71 62.8515Z" fill="#E4DCD3"/>
								<path d="M122.583 69.254C122.583 69.254 117.781 64.5588 110.098 66.1595C102.415 67.7601 99.8539 73.9492 99.8539 73.9492L122.583 69.254Z" fill="#E4DCD3"/>
								<path d="M99.8544 74.056C99.8544 74.056 104.656 78.7512 112.339 77.1506C120.022 75.5499 122.583 69.3608 122.583 69.3608L99.8544 74.056Z" fill="#E4DCD3"/>
								<path d="M111.485 83.873C111.485 83.873 107.857 77.8973 99.6402 77.4705C91.4236 77.0437 87.1553 82.6992 87.1553 82.6992L111.485 83.873Z" fill="#E4DCD3"/>
								<path d="M87.049 82.5925C87.049 82.5925 90.677 88.5682 98.8936 88.9951C107.11 89.4219 111.379 83.7663 111.379 83.7663L87.049 82.5925Z" fill="#E4DCD3"/>
								<path d="M95.799 96.4647C95.799 96.4647 94.1984 89.3152 86.1952 86.1139C78.1921 82.9127 72.1097 87.0743 72.1097 87.0743L95.799 96.4647Z" fill="#E4DCD3"/>
								<path d="M72.11 87.0742C72.11 87.0742 73.7106 94.2237 81.7138 97.425C89.7169 100.626 95.7993 96.4646 95.7993 96.4646L72.11 87.0742Z" fill="#E4DCD3"/>
							</g>

							<path d="M70.4028 81.5255V85.367C70.4028 85.367 112.766 79.8181 112.766 37.3481C112.766 31.4791 111.486 22.4088 107.324 14.1923C107.324 14.1923 110.632 23.0491 110.632 37.3481C110.525 51.647 99.2141 75.4431 70.4028 81.5255Z" fill="#E4DCD3"/>
						</svg>
						<div class="power__text df-slideUp">
							1&nbsp;место по&nbsp;качеству в&nbsp;рейтинге JD&nbsp;Power United States в&nbsp;2018&nbsp;г.
						</div>
					</div>
					<div class="service__graph">
						<div class="service__back df-back">
							<div class="df-back__wrap">
								<div class="df-back__img js-set-color" data-bg="/images/brand/p-mobility/img/5-5.jpg"></div>
							</div>
						</div>
						<div class="service__wrapper">
							<div class="service__img df-img">
								<div class="service__parallax df-img__parallax parallax">
									<div class="df-img__wrap">
										<div class="df-img__img js-set-color" data-bg="/images/brand/p-mobility/img/5.jpg"></div>
									</div>
								</div>
							</div>
							<div class="service__description df-description">
								<h2 class="h1 df-title service__title">
									Обслуживание
									<br>клиентов
								</h2>
								<div class="df-lead-text-22px df-text service__text">
									Полный набор ведущих в&nbsp;мире интеллектуальных устройств, в&nbsp;их&nbsp;число входит:
									<ul>
										<li>
											сервис автоматизации нашего сервисного центра с&nbsp;цифровыми этапами обслуживания;
										</li>
										<li>
											Hyundai Visual Guide;
										</li>
										<li>
											руководство для пользователей виртуальной реальности;
										</li>
										<li>
											мобильная диагностическая система следующего поколения и&nbsp;наша служба удаленной диагностики;
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="links">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="links__inner">
					<ul class="links__list js-carousel-2">
						<li class="links__item">
							<a href="/i30N" class="links__link">
								<div class="links__img">
									<div data-bg="/images/brand/p-mobility/img/l-2.jpg"></div>
								</div>
								<h3 class="links__title">i30 N</h3>
								<div class="links__description">
									Автомобиль c&nbsp;бешеным пульсом.
								</div>
							</a>
						</li>
						<li class="links__item">
							<a href="/veloster-n" class="links__link">
								<div class="links__img">
									<div data-bg="/images/brand/p-mobility/img/l-1.jpg"></div>
								</div>
								<h3 class="links__title">Veloster N</h3>
								<div class="links__description">
									Непреклонный бунтарь.
								</div>
							</a>
						</li>
						<li class="links__item">
							<a href="/motorsport" class="links__link">
								<div class="links__img">
									<div data-bg="/images/brand/p-mobility/img/i-3.jpg"></div>
								</div>
								<h3 class="links__title">Motorsport</h3>
								<div class="links__description">
									Hyundai в спорте.
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')
	<script src="{{ mix('/js/brand/p-mobility/libs.js') }}"></script>
    <script src="{{ mix('/js/brand/p-mobility/index.js') }}"></script>
@endsection
