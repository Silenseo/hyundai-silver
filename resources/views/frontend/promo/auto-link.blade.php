@extends('layouts.master')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')

@section('styles')
    <link rel="stylesheet" href="/css/autolink/index.css">
@endsection

@section('content')
<section class="banner df-main-banner">
	<div class="container-fluid df-main-banner__wrap">
		<div class="row">
			<div class="col-md-12">
				<a href="/offers" class="df-back-link">
					Все предложения
					<svg>
						<use xlink:href="#back-link"></use>
					</svg>
				</a>
				<div class="banner__inner df-main-banner__inner lazyload lazypreview" data-bgset="/images/autoLink/banner_mobile.jpg [(max-width: 640px)] | /images/autoLink/banner.jpg">
					<h1 class="df-main-banner__title">Auto Link</h1>
					<div class="df-main-banner__subtitle">
						Охранно-телематический комплекс.
					</div>
					<div class="banner__buttons">
						<a target="_blank" href="https://apps.apple.com/ru/app/hyundai-auto-link/id1467685378" class="banner__button">
							<img src="/images/autoLink/app_store.svg" alt="">
						</a>
						<a target="_blank" href="https://play.google.com/store/apps/details?id=com.hyundai.autolink.ru" class="banner__button">
							<img src="/images/autoLink/play.svg" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="features">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="features__title">Преимущества Auto Link</h2>
				<div class="features__body">
					<div class="features__left">
						<ul class="features__list">
							<li class="features__item">
								Управление автомобилем прямо со своего смартфона.
							</li>
							<li class="features__item">
								Умный климат-контроль, дистанционный и автоматический запуск двигателя.
							</li>
							<li class="features__item">
								Мониторинг местонахождения автомобиля с точностью до нескольких метров.
							</li>
							<li class="features__item">
								Интеллектуальный 3D-контроль: регистрация ударов, эвакуации.
							</li>
						</ul>
					</div>
					<div class="features__right">
						<ul class="features__list">
							<li class="features__item">
								Дистанционная диагностика состояния автомобиля.
							</li>
							<li class="features__item">
								История вождения: средняя скорость, пробег, расход топлива, ускорение и торможения.
							</li>
							<li class="features__item">
								Специальные условия от страховых компаний на полисы КАСКО.
							</li>
							<li class="features__item">
								Специальные предложения на ремонт и обслуживание.
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
	<script src="{{ mix('/js/lazypreview.js') }}"></script>
    <script src="{{ mix('/js/autolink/libs.js') }}"></script>
@endsection
