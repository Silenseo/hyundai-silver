@extends('layouts.master')

@section('pageTitle', 'Brand-collection')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/brandCollection/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/brandCollection/brand-collection.css') }}">
@endsection

@section('content')

@component('components/plugin-map')@endcomponent

<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner__center">
					<div class="banner__composition">
						<h1 class="banner__title">Бренд-коллекция.</h1>
						<div class="banner__subtitle df-banner-subline">Ваш уникальный стиль.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<nav class="nav" role="navigation">
	<a href="#" class="nav__head js-menu-open">
		<span class="nav__current"></span>
		<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="white"/>
		</svg>
	</a>
	<ul class="nav__menu">
		<li class="nav__item">
			<a href="/brand-collection" class="nav__link df-text-radio-button-14px {{ Request::is('brand-collection') ? 'active' : '' }}">Главная</a>
		</li>
		@foreach($menu_cats as $cat)
		<li class="nav__item">
			<a href="/brand-collection/{{ $cat->code }}" class="nav__link df-text-radio-button-14px {{ Request::is('brand-collection/' . $cat->code) ? 'active' : '' }}">{{ $cat->name }}</a>
		</li>
		@endforeach
		<li class="nav__item">
			<a href="/brand-collection/all" class="nav__link df-text-radio-button-14px {{ Request::is('brand-collection/all') ? 'active' : '' }}">Весь каталог</a>
		</li>
		<li class="nav__item">
			<a href="/brand-collection/where-buy" class="nav__link df-text-radio-button-14px {{ Request::is('brand-collection/where-buy') ? 'active' : '' }}">Где купить</a>
		</li>
	</ul>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<section class="main-list">
				<div class="filters">
					@if(!empty($tags))
					<div class="filters__top">
						<div class="filters__title h4">Фильтры</div>
						<a href="#" class="filters__reset df-text-radio-button-14px js-reset-filters">
							Сбросить все
							<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="0.00012207" y="7.27271" width="10.2851" height="1.02851" transform="rotate(-45 0.00012207 7.27271)"/>
								<rect x="0.727295" width="10.2851" height="1.02851" transform="rotate(45 0.727295 0)"/>
							</svg>
						</a>
					</div>
					<ul class="filters__list">
						@foreach($tags as $tag)
						<li class="filters__item">
							<label>
								<input type="checkbox" name="tag" value="{{ $tag->id }}">
								<div class="filters__box"></div>
								<div class="filters__name">{{ $tag->name }}</div>
							</label>
						</li>
						@endforeach
					</ul>
					@endif
				</div>
				<div class="products">
					<ul class="products__list">
						@foreach($items as $item)
						<li class="products__item" data-tag="{{ $item->tag->id }}">
							<a href="#" class="product" data-id="{{ $item->id }}">
								<div class="product__img">
									<img src="{{ $item->getImageUrl() }}" alt="">
								</div>
								<div class="product__name">{{ $item->name }}</div>
								<div class="product__price">{{ number_format($item->price, 0, '.', ' ') }} ₽</div>
								<div class="product__art product__hidden">{{ $item->article }}</div>
								<div class="product__description product__hidden">{!! $item->description !!}</div>
								<div class="product__material product__hidden">{{ $item->material }}</div>
								<div class="product__size product__hidden">{{ $item->size }}</div>
							</a>
						</li>
						@endforeach
					</ul>
				</div>
			</section>
		</div>
	</div>
</div>



@component('frontend/brandCollection/popup-product')@endcomponent

@endsection

@section('scripts')
    <script src="{{ mix('/js/brandCollection/libs.js') }}"></script>
    <script src="{{ mix('/js/brandCollection/brand-collection.js') }}"></script>
    <script src="{{ mix('/js/brandCollection/buy.js') }}"></script>
@endsection
