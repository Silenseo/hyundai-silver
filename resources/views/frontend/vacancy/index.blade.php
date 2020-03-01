@extends('layouts.master')

@section('pageTitle', 'Вакансии')

@section('styles')
	<link rel="stylesheet" href="{{ mix('/css/vacancy/libs.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/vacancy/vacancy.css') }}">
@endsection

@section('content')

<section class="vacancy">
	<div class="container scroll-section">
		<div class="row">
			<div class="col-lg-7 col-md-12">
				<div class="sidebar__wrap">
					<div class="sidebar">
						<div class="sidebar__top">
							Москва
							<!-- <select class="df-select sidebar__dropdown" name="" id="js-city-select" placeholder="Выбрать">
								<option></option>
								<option value="Москва">Москва</option>
								<option value="Челябинск">Челябинск</option>
								<option value="Орел">Орел</option>
								<option value="Архангельск">Архангельск</option>
								<option value="Барнаул">Барнаул</option>
								<option value="Серпухов">Серпухов</option>
								<option value="Новосибирск">Новосибирск</option>
							</select> -->
						</div>
						<h3 class="sidebar__title">Выберите направление, в&nbsp;котором хотели&nbsp;бы развиваться вместе с&nbsp;HYUNDAI</h3>
						<div class="sidebar__subtitle">
							Для студентов московских вузов мы&nbsp;предлагаем программу &laquo;Начни Карьеру в&nbsp;Хендэ!&raquo;&nbsp;&mdash; ежегодные стажировки, которые позволяют студентам применять свои знания на&nbsp;практике и&nbsp;принимать участие в&nbsp;реальных проектах подразделений &laquo;Хендэ Мотор СНГ&raquo;. Стажировки проходят два раза в&nbsp;год: зимой (февраль-март) и&nbsp;летом (июль&nbsp;&mdash; август).
							Если вы&nbsp;хотите подать заявку на&nbsp;участие в&nbsp;стажировке, заполните, пожалуйста, анкету ниже.
						</div>
						<button class="focus-button"></button>
						<ul class="sidebar__controls">
							<li class="sidebar__control">
								<button data-title="Выберите направление, в&nbsp;котором хотели&nbsp;бы развиваться вместе с&nbsp;HYUNDAI" data-tab="accordion" class="js-change-tab df-button" href="#">Соискателям</button>
							</li>
							<li class="sidebar__control">
								<button data-title="Заполните анкету для получения информации о начале стажировки" data-tab="form" class="js-change-tab df-button" href="#">Стажерам</button>
							</li>
						</ul>

						<div data-section="accordion" class="js-section" style="display: none">
							<ul class="accordion">
								<?php $k = 0; ?>
								<?php foreach($vacancyList as $group=>$vacancies) :?>
									<?php $k++; ?>
								<li class="accordion__item">
									<a href="#" class="accordion__head js-open-section">
										<div class="accordion__icon">
											<?php if ($k % 3 == 1) : ?>
											<img src="/images/vacancy/icons/Paper.svg" alt="">
											<?php elseif($k % 3 == 2) : ?>
											<img src="/images/vacancy/icons/Design.svg" alt="">
											<?php elseif($k % 3 == 0) : ?>
											<img src="/images/vacancy/icons/Mic.svg" alt="">
											<?php endif; ?>
<!-- 											<img src="/images/vacancy/icons/Mic.svg" alt=""> -->
										</div>
										<h5 class="accordion__title">
											{{ $group }}
										</h5>
										<div class="accordion__count">
											@if(count($vacancies) == 1)
												{{ count($vacancies) }}  вакансия
											@elseif(count($vacancies) > 1 && count($vacancies) < 5)
												{{ count($vacancies) }} вакансии
											@else
												{{ count($vacancies) }} вакансий
											@endif
										</div>
									</a>
									<ul class="accordion__dropdown">
										@foreach($vacancies as $vacancy)
										<li class="accordion__d-item">
											<a href="/vacancy/{{ $vacancy['id'] }}" class="accordion__link">
												<h6 class="accordion__subtitle">
													{{ $vacancy['name'] }}
												</h6>
											</a>
										</li>
										@endforeach
									</ul>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>

						<div data-section="form" class="js-section" id="vacancy-form">
							<div v-if="!init">
								@component('components/placeholder')@endcomponent
							</div>
							<vacancy-form v-else></vacancy-form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Слайдер в разделе вакансии -->
<div data-section="accordion" class="slider slider--1 js-section">
	<ul class="slider__list js-slider owl-carousel">
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/team__3.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/team__1.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/team__2.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/team__4.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/team__5.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/team__6.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/team__7.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider_new/Mask-Group.jpg">
		</li>
	</ul>
	<div class="slider__indicator">
		<div class="slider__current"></div>
		<div class="slider__separator">/</div>
		<div class="slider__length"></div>
	</div>
</div>

<!-- Слайдер в разделе с формой -->
<div data-section="form" class="slider slider--2 js-section">
	<ul class="slider__list js-slider2 owl-carousel">
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__1.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__2.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__3.jpg">
		</li>

		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__4.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__41.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__5.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__31.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/trainee__6.jpg">
		</li>
	</ul>
	<div class="slider__indicator">
		<div class="slider__current2"></div>
		<div class="slider__separator">/</div>
		<div class="slider__length2"></div>
	</div>
</div>

@endsection

@section('scripts')
	<script src="{{ mix('/js/vacancy/libs.js') }}"></script>
	<script src="{{ mix('/js/vacancy/vacancy.js') }}"></script>
	<script src="{{ mix('/js/vacancy/vacancy-form.js') }}"></script>
@endsection
