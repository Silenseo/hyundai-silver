@extends('layouts.master')

@section('pageTitle', 'Hyundai NEXO')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/cars/nexo/libs.css') }}">
  <link rel="stylesheet" href="{{ mix('/css/cars/nexo/nexo.css') }}">
@endsection

@section('content')

<section class="section header">
	<div class="header__center">
		<img src="/images/cars/nexo/main-sm.jpg" alt="" class="header__img-mobile">
		<h1 class="h1 header__title">nexo*</h1>
		<div class="header__note">*Данная модель недоступна на территории Российской Федерации.</div>
	</div>
</section>

<section class="section section--white for-you">
	<h2 class="for-you__title h2">Для вас.</h2>
	<div class="for-you__text default-text">
		NEXO был создан c&nbsp;ориентиром на&nbsp;наш общий свободный и&nbsp;чистый завтрашний день. Такой, в&nbsp;котором автомобиль существует с&nbsp;нами в&nbsp;единой среде, не&nbsp;мешая никому, не&nbsp;издавая ни&nbsp;звука и&nbsp;не&nbsp;оставляя и&nbsp;следа загрязнения. Это простая философия. Всё что было создано&nbsp;&mdash; сделано для вас. NEXO не&nbsp;изменит следующее поколение автомобилистов, он&nbsp;изменит привычный стиль жизни.<br>
	</div>
	<div class="for-you__video">
		<iframe src="https://www.youtube.com/embed/b9W46sQsaJo?rel=0&enablejsapi=1&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<div class="for-you__preview">
			<a href="#" class="for-you__button js-play-video">
				<svg version="1.1"
					id="Слой_1" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"
					xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125"
					style="enable-background:new 0 0 100 125;" xml:space="preserve">
					<style type="text/css">
						.st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
					</style>
					<g transform="translate(0,-952.36218)">
						<path class="st0" d="M50,959.4c-23.7,0-43,19.3-43,43c0,23.7,19.3,43,43,43s43-19.3,43-43C93,978.6,73.7,959.4,50,959.4z
							M38.2,1021.4l0.3-19l0.3-19l16.3,9.7l16.3,9.7l-16.6,9.3L38.2,1021.4z"/>
					</g>
				</svg>
			</a>
		</div>
	</div>
</section>

<section class="section for-every">
	<div class="section__center">
		<h2 class="for-every__title h2">Для каждого.</h2>
		<div class="for-every__text default-text">
			У&nbsp;каждого есть свой взгляд на&nbsp;будущее. Наш состоит в&nbsp;том, чтобы сделать мир лучше для вас и&nbsp;для любого из&nbsp;людей. NEXO&nbsp;&mdash; это нулевой уровень вредных выбросов, очищение воздуха, а&nbsp;не&nbsp;его загрязнение. Он&nbsp;открывает для каждого дорогу в&nbsp;лучшее будущее, без ограничений.
		</div>
		<div class="for-every__img">
			<img src="/images/cars/nexo/04.jpg" alt="">
		</div>
	</div>
</section>

<section class="section section--white hydrogen">
	<div class="section__center">
		<div class="item">
			<div class="item__text">
				<h2 class="h2 item__title">Водород &mdash;<br>
				топливо будущего.</h2>
				<div class="default-text">
					Мы&nbsp;уверены, что водородное топливо это ключ<br>
					к&nbsp;построению лучшего будущего для всех нас.
				</div>
			</div>
			<div class="item__img" style="background-image: url(/images/cars/nexo/nexo-fe-highlights-hydrogen-the-future-of-fuel-original.jpg)"></div>
		</div>
		<div class="item item--reverse">
			<div class="item__text item__text--right">
				<h2 class="h2 item__title">Единственный<br>
				выброс&nbsp;&mdash; вода.</h2>
				<div class="default-text">
					Двигатель NEXO на&nbsp;водородных топливных элементах генерирует энергию при смешении кислорода со&nbsp;сжатым водородом, создавая поток электронов. Он&nbsp;эффективен, надёжен и&nbsp;на&nbsp;выходе получается лишь чистая вода.
				</div>
			</div>
			<div class="item__img" style="background-image: url(/images/cars/nexo/nexo-fe-highlights-water-the-only-emission-original.jpg)"></div>
		</div>
	</div>
</section>

<section class="section for-him">
	<div class="section__center">
		<h2 class="for-him__title h2">Для него.</h2>
		<div class="for-him__text default-text">
			Воздух становится чище, чтобы ты&nbsp;мог дышать свободно в&nbsp;здоровой атмосфере сегодня, как и&nbsp;в&nbsp;будущем.
		</div>
		<div class="for-him__img">
			<img src="/images/cars/nexo/11.jpg" alt="">
		</div>
	</div>
</section>

<section class="section section--white purification">
	<div class="section__center">
		<div class="item">
			<div class="item__text">
				<h2 class="h2 item__title">Очищение воздуха<br>
				для лучшего будущего.</h2>
				<div class="default-text">
					Эффективный и&nbsp;высокопроизводительный воздушный фильтр фильтрует и&nbsp;удаляет до&nbsp;99.9% микрочастиц. Технологии NEXO помогают уменьшать выбросы углерода при каждой поездке.
				</div>
			</div>
			<div class="item__img" style="background-image: url(/images/cars/nexo/13.jpg)"></div>
		</div>
	</div>
</section>

<section class="section for-them">
	<div class="section__center">
		<h2 class="for-them__title h2">Для них.</h2>
		<div class="for-them__text default-text">
			Тем, кто привык к&nbsp;жизни в&nbsp;ускоренном ритме NEXO дарит свободу от&nbsp;долгих часов простоя для зарядки электрических батарей. Вперёд&nbsp;&mdash; к&nbsp;активной жизни, полной событий и&nbsp;эмоций.
		</div>
		<div class="for-them__img">
			<img src="/images/cars/nexo/08.jpg" alt="">
		</div>
	</div>
</section>

<section class="section section--white fast">
	<div class="section__center">
		<div class="item">
			<div class="item__text">
				<h2 class="h2 item__title">Быстрая дозаправка,<br>
				впечатляющие<br>
				расстояния.</h2>
				<div class="default-text">
					Водородные топливные элементы заряжаются всего за&nbsp;пять минут и&nbsp;обеспечивают 600&nbsp;км хода. Показатели сопоставимые с&nbsp;большинством бензиновых автомобилей и&nbsp;впечатляющие всех, даже самых нетерпеливых пассажиров и&nbsp;водителей.
				</div>
			</div>
			<div class="item__img" style="background-image: url(/images/cars/nexo/09.jpg)"></div>
		</div>
	</div>
</section>

<section class="section gallery">
	<div class="section__center">
		<h2 class="gallery__title h2">Галерея</h2>
		<div id="gallery" class="galleryTy1">
			<div class="slideWrap bigImg">
				<div class="pageNum">
					<strong>1</strong> / 6
				</div>
				<ul class="slideArea swiper-wrapper">
					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/01.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/02.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/03.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/04.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/05.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/06.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/07.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/08.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/09.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/10.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/11.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/12.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/13.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/14.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/15.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/16.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/17.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/18.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/19.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/20.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/21.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/22.jpg"
							class="responsive-image">
					</li>

					<li class="swiper-slide colorw">
						<img src="/images/cars/nexo/23.jpg"
							class="responsive-image">
					</li>
				</ul>
				<p class="btn_prev">
					<button class="prev">prev</button>
				</p>
				<p class="btn_next">
					<button class="next">next</button>
				</p>
			</div>
			<!-- //slideWrap bigImg -->
			<div class="slideWrap thumbnail">
				<ul class="slideArea swiper-wrapper">
					<li class="swiper-slide on">
						<button>
							<img src="/images/cars/nexo/01.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide swiper-slide-next">
						<button>
							<img src="/images/cars/nexo/02.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/03.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/04.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/05.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/06.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/07.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/08.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/09.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/10.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/11.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/12.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/13.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/14.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/15.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/16.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/17.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/18.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/19.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/20.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/21.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/22.jpg"
							class="responsive-image">
						</button>
					</li>

					<li class="swiper-slide">
						<button>
							<img src="/images/cars/nexo/23.jpg"
							class="responsive-image">
						</button>
					</li>
				</ul>
				<p class="btn_prev">
					<button class="prev">prev</button>
				</p>
				<p class="btn_next">
					<button class="next">next</button>
				</p>
			</div>
			<!-- //slideWrap thumbnail -->
		</div>
	</div>
</section>

<div class="foot-nav">
	<div class="foot-nav__center">
		<a href="https://www.hyundai.com/worldwide/en/eco/nexo/because-of-you" class="df-forward-link">
			Перейти на английскую версию страницы
			<svg>
				<use xlink:href="#forward-link"></use>
			</svg>
		</a>
	</div>
</div>

@endsection

@section('scripts')
  <script src="{{ mix('/js/cars/nexo/libs.js') }}"></script>
  <script src="{{ mix('/js/cars/nexo/nexo.js') }}"></script>
@endsection
