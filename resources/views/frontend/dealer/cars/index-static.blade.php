@extends('layouts.master-dealer')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')
@section('pageDescription', 'Официальный сайт Hyundai: модели и актуальные цены, обзоры и фото автомобилей, новости, запись на тест-драйв. Спешите купить новый Hyundai!')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/dealer/css/cars/showroom-static.css') }}">
@endsection

@section('content')

<div class="filters">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="filters__inner">
					<div class="filters__top">
						<h1 class="filters__title h3">Автомобили в наличии</h1>
						<div class="age">
							<ul class="age__list">
								<li class="age__item">
									<label>
										<input type="radio" name="age" checked>
										<div class="age__box">
											Все
										</div>
									</label>
								</li>
								<li class="age__item">
									<label>
										<input type="radio" name="age">
										<div class="age__box">
											Новые
										</div>
									</label>
								</li>
								<li class="age__item">
									<label>
										<input type="radio" name="age">
										<div class="age__box">
											С пробегом
										</div>
									</label>
								</li>
							</ul>
						</div>
					</div>
					<div class="filters__list">
						<div class="filters__dd active">
							<div class="dd-multi active">
								<a href="#" class="dd-multi__head active">
									Модель
									<div class="dd-multi__arrow active">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear active">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown active">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-multi">
								<a href="#" class="dd-multi__head">
									Год выпуска
									<div class="dd-multi__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-multi">
								<a href="#" class="dd-multi__head">
									Коробка передач
									<div class="dd-multi__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-range active">
								<a href="#" class="dd-range__head active">
									Цена
									<div class="dd-range__arrow active">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-range__clear active">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown active">
									<div class="dropdown__body">
										<div class="dropdown__from">
											<span>От</span>
											<input class="df-input" type="text">
										</div>
										<div class="dropdown__to">
											<span>До</span>
											<input class="df-input" type="text">
										</div>
									</div>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-multi">
								<a href="#" class="dd-multi__head">
									Двигатель
									<div class="dd-multi__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-multi">
								<a href="#" class="dd-multi__head">
									Комплектация
									<div class="dd-multi__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-multi">
								<a href="#" class="dd-multi__head">
									Тип привода
									<div class="dd-multi__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-range">
								<a href="#" class="dd-range__head">
									Пробег
									<div class="dd-range__arrow active">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-range__clear active">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__body">
										<div class="dropdown__from">
											<span>От</span>
											<input class="df-input" type="text">
										</div>
										<div class="dropdown__to">
											<span>До</span>
											<input class="df-input" type="text">
										</div>
									</div>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-multi">
								<a href="#" class="dd-multi__head">
									Цвет кузова
									<div class="dd-multi__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
						<div class="filters__dd">
							<div class="dd-multi">
								<a href="#" class="dd-multi__head">
									Цвет салона
									<div class="dd-multi__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
									<div class="dd-multi__clear">
										<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
											<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown">
									<div class="dropdown__top">
										<div class="dropdown__select">Выбрать:</div>
										<a href="#" class="dropdown__value">все</a>
									</div>
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 1</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 2</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="checkbox">
												<div class="dropdown__box">
													<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
													</svg>
												</div>
												<div class="dropdown__description">Модель 3</div>
											</label>
										</li>
									</ul>
									<div class="dropdown__footer">
										<button class="df-button dropdown__button">Применить</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="filters__footer">
						<a href="#" class="filters__more">
							<span>Все параметры</span>
							<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.5 5.5L5.83103 1.60207C6.21134 1.25979 6.78866 1.25979 7.16896 1.60207L11.5 5.5" stroke="currentColor" stroke-width="2"/>
							</svg>
						</a>
						<a href="#" class="filters__clear">
							<span>Сбросить</span>
							<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect y="10.9091" width="15.4277" height="1.54277" transform="rotate(-45 0 10.9091)" fill="#666666"/>
								<rect x="1.0918" width="15.4277" height="1.54277" transform="rotate(45 1.0918 0)" fill="#666666"/>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="d-list">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="d-list__inner">
					<div class="d-list__top">
						<div class="d-list__sort">
							<div class="dd-sort active">
								<a href="#" class="dd-sort__head active">
									Выберите тип сортировки
									<div class="dd-sort__arrow">
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
										</svg>
									</div>
								</a>
								<div class="dropdown active">
									<ul class="dropdown__list">
										<li class="dropdown__item">
											<label>
												<input type="radio" name="sort">
												<div class="dropdown__description">
													Тип 1
												</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="radio" name="sort">
												<div class="dropdown__description">
													Тип 2
												</div>
											</label>
										</li>
										<li class="dropdown__item">
											<label>
												<input type="radio" name="sort">
												<div class="dropdown__description">
													Тип 3
												</div>
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="d-list__amount">
							5 <span>автомобилей</span>
						</div>
					</div>
					<ul class="d-list__list">
						<li class="d-list__item">
							<div class="s-car">
								<div class="s-car__line s-car__line--1">
									<div class="s-car__name">Elantra</div>
									<div class="s-car__year">2019</div>
								</div>
								<div class="s-car__line s-car__line--2">
									<div class="s-car__price">694 900 <span>— 954 900</span> ₽</div>
									<div class="s-car__credit">от 6 000 ₽/мес.</div>
								</div>
								<div class="s-car__img">
									<div class="car-preview">
										<div class="car-preview__container">
											<div class="car-preview__img" style="background-image: url(/dealer/images/cars/elantra.png);"></div>
										</div>
										<ul class="car-preview__nav">
											<li class="car-preview__item active"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
										</ul>
									</div>
								</div>
								<div class="s-car__description">
									Седан 5дв. / Передний / Механика Travel / 1.4 / 100 л.с / бензин
								</div>
								<div class="s-car__footer">
									<button class="df-button s-car__book">Забронировать</button>
									<button class="df-button s-car__calc">Рассчитать кредит</button>
								</div>
							</div>
						</li>
						<li class="d-list__item">
							<div class="s-car">
								<div class="s-car__line s-car__line--1">
									<div class="s-car__name">Elantra</div>
									<div class="s-car__year">2019</div>
								</div>
								<div class="s-car__line s-car__line--2">
									<div class="s-car__price">694 900 <span>— 954 900</span> ₽</div>
									<div class="s-car__credit">от 6 000 ₽/мес.</div>
								</div>
								<div class="s-car__img">
									<div class="car-preview">
										<div class="car-preview__container">
											<div class="car-preview__img" style="background-image: url(/dealer/images/cars/elantra.png);"></div>
										</div>
										<ul class="car-preview__nav">
											<li class="car-preview__item active"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
										</ul>
									</div>
								</div>
								<div class="s-car__description">
									Седан 5дв. / Передний / Механика Travel / 1.4 / 100 л.с / бензин
								</div>
								<div class="s-car__footer">
									<button class="df-button s-car__book">Забронировать</button>
									<button class="df-button s-car__calc">Рассчитать кредит</button>
								</div>
							</div>
						</li>
						<li class="d-list__item">
							<div class="s-car">
								<div class="s-car__line s-car__line--1">
									<div class="s-car__name">Elantra</div>
									<div class="s-car__year">2019</div>
								</div>
								<div class="s-car__line s-car__line--2">
									<div class="s-car__price">694 900 <span>— 954 900</span> ₽</div>
									<div class="s-car__credit">от 6 000 ₽/мес.</div>
								</div>
								<div class="s-car__img">
									<div class="car-preview">
										<div class="car-preview__container">
											<div class="car-preview__img" style="background-image: url(/dealer/images/cars/elantra.png);"></div>
										</div>
										<ul class="car-preview__nav">
											<li class="car-preview__item active"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
										</ul>
									</div>
								</div>
								<div class="s-car__description">
									Седан 5дв. / Передний / Механика Travel / 1.4 / 100 л.с / бензин
								</div>
								<div class="s-car__footer">
									<button class="df-button s-car__book">Забронировать</button>
									<button class="df-button s-car__calc">Рассчитать кредит</button>
								</div>
							</div>
						</li>
						<li class="d-list__item">
							<div class="s-car">
								<div class="s-car__line s-car__line--1">
									<div class="s-car__name">Elantra</div>
									<div class="s-car__year">2019</div>
								</div>
								<div class="s-car__line s-car__line--2">
									<div class="s-car__price">694 900 <span>— 954 900</span> ₽</div>
									<div class="s-car__credit">от 6 000 ₽/мес.</div>
								</div>
								<div class="s-car__img">
									<div class="car-preview">
										<div class="car-preview__container">
											<div class="car-preview__img" style="background-image: url(/dealer/images/cars/elantra.png);"></div>
										</div>
										<ul class="car-preview__nav">
											<li class="car-preview__item active"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
										</ul>
									</div>
								</div>
								<div class="s-car__description">
									Седан 5дв. / Передний / Механика Travel / 1.4 / 100 л.с / бензин
								</div>
								<div class="s-car__footer">
									<button class="df-button s-car__book">Забронировать</button>
									<button class="df-button s-car__calc">Рассчитать кредит</button>
								</div>
							</div>
						</li>
						<li class="d-list__item">
							<div class="s-car">
								<div class="s-car__line s-car__line--1">
									<div class="s-car__name">Elantra</div>
									<div class="s-car__year">2019</div>
								</div>
								<div class="s-car__line s-car__line--2">
									<div class="s-car__price">694 900 <span>— 954 900</span> ₽</div>
									<div class="s-car__credit">от 6 000 ₽/мес.</div>
								</div>
								<div class="s-car__img">
									<div class="car-preview">
										<div class="car-preview__container">
											<div class="car-preview__img" style="background-image: url(/dealer/images/cars/elantra.png);"></div>
										</div>
										<ul class="car-preview__nav">
											<li class="car-preview__item active"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
										</ul>
									</div>
								</div>
								<div class="s-car__description">
									Седан 5дв. / Передний / Механика Travel / 1.4 / 100 л.с / бензин
								</div>
								<div class="s-car__footer">
									<button class="df-button s-car__book">Забронировать</button>
									<button class="df-button s-car__calc">Рассчитать кредит</button>
								</div>
							</div>
						</li>
						<li class="d-list__item">
							<div class="s-car">
								<div class="s-car__line s-car__line--1">
									<div class="s-car__name">Elantra</div>
									<div class="s-car__year">2019</div>
								</div>
								<div class="s-car__line s-car__line--2">
									<div class="s-car__price">694 900 <span>— 954 900</span> ₽</div>
									<div class="s-car__credit">от 6 000 ₽/мес.</div>
								</div>
								<div class="s-car__img">
									<div class="car-preview">
										<div class="car-preview__container">
											<div class="car-preview__img" style="background-image: url(/dealer/images/cars/elantra.png);"></div>
										</div>
										<ul class="car-preview__nav">
											<li class="car-preview__item active"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
											<li class="car-preview__item"></li>
										</ul>
									</div>
								</div>
								<div class="s-car__description">
									Седан 5дв. / Передний / Механика Travel / 1.4 / 100 л.с / бензин
								</div>
								<div class="s-car__footer">
									<button class="df-button s-car__book">Забронировать</button>
									<button class="df-button s-car__calc">Рассчитать кредит</button>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

