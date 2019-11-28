@extends('layouts.master')

@section('pageTitle', 'Будущее передвижений')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/brand/history/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/brand/mobility/index.css') }}">
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

<section class="before">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="before__inner">
					<div class="before__year">2019</div>
					<h1 class="h1 before__title">
						Будущее передвижений
					</h1>
					<div class="before__subtitle">
						Автомобили для жизни
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="history history--ru">
	<div class="history__main-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="history__inner history__inner--ru">
    					<div class="ico2">
					        <img src="/images/brand/mobility/img/ico1.png"/>
					    </div>
						<ul class="history__line">
							<li class="history__item history__item--ru" id="2007" data-year="2007">
								<article>
									<div class="history__back history__back--12" data-bg="/images/brand/mobility/img/12.jpeg"></div>
									<div class="history__wrapper history__wrapper--12">
										<div class="history__img history__img--12" data-bg="/images/brand/mobility/img/12.1.jpeg"></div>
									</div>
									<div class="history__text-wrapper history__text-wrapper-0">
    										<h2 class="h1 history__subtitle history__subtitle--12">
    											Инновации будущего образа жизни
    										</h2>
    										<div class="history__text history__text--12">
    											Мы хотим превратить автомобиль из обычного транспортного средства, которым он сейчас является, в новое пространство, соединяющее людей друг с другом, с их семьями, работой и обществом.
    										</div>
										</div>
								</article>
							</li>
							<li class="history__item" id="1968" data-year="1968">
								<article>
									<div class="history__text-wrapper history__text-wrapper-1">
									    <div class="history__text-ico1">
									        <img src="/images/brand/mobility/img/b2_ico.png">
									    </div>
									    <div class="before__year gray-text">Connected cars</div>
										<h2 class="h2 history__subtitle">
											Автомобиль, как<br/>часть нашей жизни
										</h2>
										<div class="history__text">
											Превращая автомобиль в единую систему, на которую люди могут положиться в любом месте и в любое время, мы стремимся добавить новую ценность к традиционному автомобилю.
										</div>
                                    </div>
									<div class="history__wrapper history__wrapper--1">
										<div class="history__img history__img--1" data-bg="/images/brand/mobility/img/circle.png"></div>
									</div>
								</article>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner__inner_second">

				</div>
			</div>
		</div>
	</div>
</section>


<section class="before">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="before__inner">
					<h1 class="h1 before__title">
						Ориентироваться на человека
					</h1>
					<div class="before__subtitle">
						Мы стремимся дать нашим клиентам максимальные преимущества и пользу, обеспечив  конкурентоспособность Hyundai на мировом рынке. Это делает нас единственным автопроизводителем в мире, который предлагает все три типа автомобилей на альтернативном топливе: гибридный, электрический и гибридный.
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="history history--ru">
	<div class="history__main-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="history__inner history__inner--ru">
					    <div class="ico2">
					        <img src="/images/brand/mobility/img/ico2.png"/>
					        <img src="/images/brand/mobility/img/ico2_text.png"/>
					    </div>
						<ul class="history__line">
							<li class="history__item history__item--ru" id="2007" data-year="2007">
								<article>
									<div class="history__back history__back--15" data-bg="/images/brand/mobility/img/block2_bg.jpg"></div>
									<div class="history__wrapper history__wrapper--15">
										<div class="history__img history__img--15" data-bg="/images/brand/mobility/img/block2.jpeg"></div>
									</div>
									<div class="history__text-wrapper">
    										<h2 class="h1 history__subtitle history__subtitle--12">
    											Экологически чистые технологии
    										</h2>
    										<div class="history__text history__text--12">
    											Автомобильная команда IONIQ получила признание во всем мире благодаря
своему лучшему в своем классе аэродинамическому дизайну с экономичным расходом топлива и подключаемым гибридом.
    										</div>
										</div>
								</article>
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
	<script src="{{ mix('/js/brand/history/libs.js') }}"></script>
    <script src="{{ mix('js/brand/mobility/index.js') }}"></script>
@endsection
