@extends('layouts.master')

@section('pageTitle', 'Вакансии')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/vacancy/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/vacancy/vacancy.css') }}">
@endsection

@section('content')

<section class="vacancy vacancy--page">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-12">
				<div class="sidebar__wrap">
					<div class="sidebar">
						<a href="/vacancy" class="df-back-link sidebar__back">
                            Назад
                            <svg>
                                <use xlink:href="#back-link"></use>
                            </svg>
						</a>
						<button class="focus-button"></button>
						<h1 class="sidebar__title sidebar__title--page h3">{{ $vacancy['name'] }}</h1>
<!-- 						<div class="sidebar__pay"><?= empty($vacancy['salary']) ? 'з/п не указана' : $vacancy['salary'] ?></div> -->
						<h2 class="sidebar__subdivision h4">ООО Hyundai Motor CIS</h2>
						<div class="sidebar__address">
							 {{ $vacancy['address']['city'] . ', ' . $vacancy['address']['street'] . ', ' . $vacancy['address']['building'] }}
						</div>
						<a href="{{ $vacancy['alternate_url'] }}" role="button" class="df-button sidebar__button" target="_blank">Откликнуться на hh.ru</a>
						<div class="sidebar__description">
							Требуемый опыт работы: {{ mb_strtolower($vacancy['experience']['name']) }}
							<br>
							{{ $vacancy['employment']['name'] . ', ' . mb_strtolower($vacancy['schedule']['name']) }}
						</div>
						<section class="responsibility">
						    <?php
            				$descr = explode('<p><strong>Компания предлагает:</strong></p>', $vacancy['description']);

            				$descr = $descr[0];
            				$descr = str_replace("\n", '', $descr);

            				$descr = str_replace(Array('<p><strong>', '<p>​​​​​​<strong>'), '<h5 class="responsibility__title">', $descr);
            				$descr = str_replace('</strong></p>', '</h5>', $descr);

            //				var_dump($descr); exit;

            				$descr = str_replace('<ul>', '<ul class="responsibility__list">', $descr);
            				$descr = str_replace('</ul>', '</ul><br/><br/>', $descr);
            				$descr = str_replace('<li>', '<li class="responsibility__item">', $descr);
            				?>
                            {!! $descr !!}

						</section>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="advantages">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-12">
					<h3 class="advantages__title">
						Преимущества работы в Компании
					</h3>
					<ul class="advantages__list">
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/prof.svg" alt="">
							</div>
							<div class="advantages__description">
								Возможности для обучения и&nbsp;профессионального развития
							</div>
						</li>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/eng.svg" alt="">
							</div>
							<div class="advantages__description">
								Занятия английским языком
							</div>
						</li>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/cup.svg" alt="">
							</div>
							<div class="advantages__description">
								Оплата питания
							</div>
						</li>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/fitness.svg" alt="">
							</div>
							<div class="advantages__description">
								Компенсация расходов на&nbsp;фитнес
							</div>
						</li>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/med.svg" alt="">
							</div>
							<div class="advantages__description">
								Добровольное медицинское страхование
							</div>
						</li>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/insurance.svg" alt="">
							</div>
							<div class="advantages__description">
								Страхование от&nbsp;несчастных случаев
							</div>
						</li>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/parking.svg" alt="">
							</div>
							<div class="advantages__description">
								Частичная компенсация парковки
							</div>
						</li>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img src="/images/vacancy/icons/time.svg" alt="">
							</div>
							<div class="advantages__description">
								График работы с&nbsp;гибким началом рабочего дня 8:00&nbsp;/ 8:30&nbsp;/ 9:00
							</div>
						</li>
					</ul>

					<ul class="advantages-slider owl-carousel">
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/prof.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								Возможности для обучения и&nbsp;профессионального развития
							</div>
						</li>
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/eng.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								Занятия английским языком
							</div>
						</li>
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/cup.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								Оплата питания
							</div>
						</li>
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/fitness.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								Компенсация расходов на&nbsp;фитнес
							</div>
						</li>
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/med.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								Добровольное медицинское страхование
							</div>
						</li>
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/insurance.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								Страхование от&nbsp;несчастных случаев
							</div>
						</li>
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/parking.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								Частичная компенсация парковки
							</div>
						</li>
						<li class="advantages-slider__item">
							<div class="advantages-slider__icon">
								<img src="/images/vacancy/icons/time.svg" alt="">
							</div>
							<div class="advantages-slider__description">
								График работы с&nbsp;гибким началом рабочего дня 8:00&nbsp;/ 8:30&nbsp;/ 9:00
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
</section>

<div class="label">
	<div class="label__left">
		<h4 class="label__title">Dealer Development Quality Specialist</h4>
		<div class="label__pay">з/п не указана</div>
	</div>
	<a href="#" role="button" class="label__button df-button">Откликнуться на hh.ru</a>
</div>

<div class="slider slider--page">
	<ul class="slider__list js-slider owl-carousel">
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__1.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__3.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__4.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__5.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__6.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__2_1.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__7.jpg">
		</li>
		<li class="slider__item owl-lazy" data-src="/images/vacancy/slider/team__8.jpg">
		</li>
	</ul>
	<div class="slider__indicator">
		<div class="slider__current"></div>
		<div class="slider__separator">/</div>
		<div class="slider__length"></div>
	</div>
</div>

@endsection

@section('scripts')
    <script src="{{ mix('/js/vacancy/libs.js') }}"></script>
    <script src="{{ mix('/js/vacancy/vacancy-page.js') }}"></script>
@endsection
