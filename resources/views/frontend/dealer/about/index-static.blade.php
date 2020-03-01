@extends('layouts.master-dealer')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')
@section('pageDescription', 'Официальный сайт Hyundai: модели и актуальные цены, обзоры и фото автомобилей, новости, запись на тест-драйв. Спешите купить новый Hyundai!')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/dealer/css/about/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/about/about.css') }}">
@endsection

@section('content')

@component('components/plugin-map')@endcomponent

<section class="banner df-main-banner">
<div class="container-fluid df-main-banner__wrap">
	<div class="row">
		<div class="col-md-12">
			<div class="df-main-banner__inner lazyload lazypreview" data-bgset="/dealer/images/about/banner.jpg [(max-width: 640px)] | /dealer/images/about/banner.jpg">
				<h1 class="df-main-banner__title">КлючАвто</h1>
				<div class="df-main-banner__subtitle">
					Официальный дилер
					<br>Hyundai в России
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<section class="about">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="about__inner">
					<h2 class="about__title">О КлючАвто</h2>
					<div class="about__text">
						<p>
							Свою мастерскую молодой автомеханик Чон Джу Ен, прежде работавший грузчиком, разнорабочим и курьером, открыл в 1939 году. Но амбициозное название Hyundai — «современность», или «новое время» — появилось позже. В 1947-м его получило многопрофильное предприятие Чон Джу Ена, которое сначала выполняло подряды американских военных, потом строило дома, мосты и корабли, выпускало станки... Преуспевающая компания все больше интересовалась автопромом, и наконец в 1967 году была создана Hyundai Motor Company. Она открыла линию по производству автомобилей, работала в партнерстве с ведущими американскими и японскими компаниями, вела собственные разработки, строила заводы в Европе и Азии, шаг за шагом завоевывая авторитет на международном рынке и признание автолюбителей.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="team">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="team__inner">
					<h2 class="team__title">Наша команда</h2>
					<ul class="team__list">
						<li class="t-item">
							<div class="t-item__top">
								<div class="t-item__img">
									<img src="/dealer/images/about/photo.jpg" alt="">
								</div>
								<div class="t-item__decription">
									<div class="t-item__name">Виталий Ермаков</div>
									<div class="t-item__position">Ведущий менеджер по продажам</div>
								</div>
							</div>
							<div class="t-item__footer">
								<div class="t-item__contacts">
									<div class="t-item__iconed">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M14.0507 11.0694L14.0802 11.1039L14.1128 11.1357L16.8576 13.8111C17.008 13.9576 17.09 14.2897 16.8446 14.6485L16.7678 14.7608L16.7238 14.8895C16.724 14.8888 16.7239 14.8891 16.7231 14.8906C16.7183 14.9001 16.6899 14.9554 16.6038 15.0579C16.5121 15.1672 16.4042 15.2733 16.2858 15.3888L16.2687 15.4054L16.2525 15.4228C15.3077 16.4358 13.9762 17 12.5234 17C11.0705 17 9.73911 16.4358 8.79431 15.4228L8.78119 15.4088L8.76755 15.3952L2.59162 9.26398L2.59165 9.26395L2.58508 9.25755C0.471639 7.19755 0.471639 3.83159 2.58508 1.77159C2.93527 1.43026 3.09814 1.27531 3.34691 1.11366C3.61319 0.940627 3.89849 0.960769 4.15655 1.20828L6.89307 3.98674L6.90023 3.99401L6.90754 4.00113C7.04016 4.1304 7.12513 4.50942 6.86886 4.83617L5.99259 5.69028L5.87546 5.80444L5.80082 5.94996C5.53946 6.45945 5.53946 7.02219 5.80082 7.53167L5.87546 7.6772L5.99258 7.79135L10.2607 11.9516C10.5331 12.3195 10.9543 12.4786 11.3225 12.4786C11.6907 12.4786 12.1119 12.3195 12.3843 11.9515L13.2214 11.1357L13.2539 11.1039L13.2835 11.0694C13.4561 10.8674 13.878 10.8674 14.0507 11.0694Z" stroke="#002C5F" stroke-width="2" stroke-miterlimit="10"/>
										</svg>
										<span>+7 (495) 662-11-80</span>
									</div>
									<div class="t-item__iconed">
										<svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="1" y="1" width="16" height="11" rx="1" stroke="#002C5F" stroke-width="2"/>
											<path d="M2 2L8.41876 6.58483C8.76646 6.83319 9.23354 6.83319 9.58124 6.58483L16 2" stroke="#002C5F" stroke-width="2"/>
										</svg>
										<span>km.andreev.denis@gmail.com</span>
									</div>
								</div>
								<button data-id="0" class="t-item__call df-button js-open-callBack">Заказать звонок</button>
							</div>
						</li>
						<li class="t-item">
							<div class="t-item__top">
								<div class="t-item__img">
									<img src="/dealer/images/about/photo.jpg" alt="">
								</div>
								<div class="t-item__decription">
									<div class="t-item__name">Виталий Ермаков</div>
									<div class="t-item__position">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci corporis error mollitia, quis ab rem.</div>
								</div>
							</div>
							<div class="t-item__footer">
								<div class="t-item__contacts">
									<div class="t-item__iconed">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M14.0507 11.0694L14.0802 11.1039L14.1128 11.1357L16.8576 13.8111C17.008 13.9576 17.09 14.2897 16.8446 14.6485L16.7678 14.7608L16.7238 14.8895C16.724 14.8888 16.7239 14.8891 16.7231 14.8906C16.7183 14.9001 16.6899 14.9554 16.6038 15.0579C16.5121 15.1672 16.4042 15.2733 16.2858 15.3888L16.2687 15.4054L16.2525 15.4228C15.3077 16.4358 13.9762 17 12.5234 17C11.0705 17 9.73911 16.4358 8.79431 15.4228L8.78119 15.4088L8.76755 15.3952L2.59162 9.26398L2.59165 9.26395L2.58508 9.25755C0.471639 7.19755 0.471639 3.83159 2.58508 1.77159C2.93527 1.43026 3.09814 1.27531 3.34691 1.11366C3.61319 0.940627 3.89849 0.960769 4.15655 1.20828L6.89307 3.98674L6.90023 3.99401L6.90754 4.00113C7.04016 4.1304 7.12513 4.50942 6.86886 4.83617L5.99259 5.69028L5.87546 5.80444L5.80082 5.94996C5.53946 6.45945 5.53946 7.02219 5.80082 7.53167L5.87546 7.6772L5.99258 7.79135L10.2607 11.9516C10.5331 12.3195 10.9543 12.4786 11.3225 12.4786C11.6907 12.4786 12.1119 12.3195 12.3843 11.9515L13.2214 11.1357L13.2539 11.1039L13.2835 11.0694C13.4561 10.8674 13.878 10.8674 14.0507 11.0694Z" stroke="#002C5F" stroke-width="2" stroke-miterlimit="10"/>
										</svg>
										<span>+7 (495) 662-11-80</span>
									</div>
									<div class="t-item__iconed">
										<svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="1" y="1" width="16" height="11" rx="1" stroke="#002C5F" stroke-width="2"/>
											<path d="M2 2L8.41876 6.58483C8.76646 6.83319 9.23354 6.83319 9.58124 6.58483L16 2" stroke="#002C5F" stroke-width="2"/>
										</svg>
										<span>km.andreev.denis@gmail.comkm.andreev.denis@gmail.com</span>
									</div>
								</div>
								<button data-id="1" class="t-item__call df-button js-open-callBack">Заказать звонок</button>
							</div>
						</li>
						<li class="t-item">
							<div class="t-item__top">
								<div class="t-item__img">
									<img src="/dealer/images/about/photo.jpg" alt="">
								</div>
								<div class="t-item__decription">
									<div class="t-item__name">Виталий Ермаков</div>
									<div class="t-item__position">Lorem ipsum dolor sit amet consectetur adipisicing.</div>
								</div>
							</div>
							<div class="t-item__footer">
								<div class="t-item__contacts">
									<div class="t-item__iconed">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M14.0507 11.0694L14.0802 11.1039L14.1128 11.1357L16.8576 13.8111C17.008 13.9576 17.09 14.2897 16.8446 14.6485L16.7678 14.7608L16.7238 14.8895C16.724 14.8888 16.7239 14.8891 16.7231 14.8906C16.7183 14.9001 16.6899 14.9554 16.6038 15.0579C16.5121 15.1672 16.4042 15.2733 16.2858 15.3888L16.2687 15.4054L16.2525 15.4228C15.3077 16.4358 13.9762 17 12.5234 17C11.0705 17 9.73911 16.4358 8.79431 15.4228L8.78119 15.4088L8.76755 15.3952L2.59162 9.26398L2.59165 9.26395L2.58508 9.25755C0.471639 7.19755 0.471639 3.83159 2.58508 1.77159C2.93527 1.43026 3.09814 1.27531 3.34691 1.11366C3.61319 0.940627 3.89849 0.960769 4.15655 1.20828L6.89307 3.98674L6.90023 3.99401L6.90754 4.00113C7.04016 4.1304 7.12513 4.50942 6.86886 4.83617L5.99259 5.69028L5.87546 5.80444L5.80082 5.94996C5.53946 6.45945 5.53946 7.02219 5.80082 7.53167L5.87546 7.6772L5.99258 7.79135L10.2607 11.9516C10.5331 12.3195 10.9543 12.4786 11.3225 12.4786C11.6907 12.4786 12.1119 12.3195 12.3843 11.9515L13.2214 11.1357L13.2539 11.1039L13.2835 11.0694C13.4561 10.8674 13.878 10.8674 14.0507 11.0694Z" stroke="#002C5F" stroke-width="2" stroke-miterlimit="10"/>
										</svg>
										<span>+7 (495) 662-11-80</span>
									</div>
									<div class="t-item__iconed">
										<svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="1" y="1" width="16" height="11" rx="1" stroke="#002C5F" stroke-width="2"/>
											<path d="M2 2L8.41876 6.58483C8.76646 6.83319 9.23354 6.83319 9.58124 6.58483L16 2" stroke="#002C5F" stroke-width="2"/>
										</svg>
										<span>km.andreev.denis@gmail.com</span>
									</div>
								</div>
								<button data-id="2" class="t-item__call df-button js-open-callBack">Заказать звонок</button>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="dealer">
	<!-- 
		Входные параметры:
		*from-hour: Number (Час начала работы для звонка клиенту)
		*to-hour: Number (Час окончания работы + 55 минут для звонка клиенту)
		*type: Number (Тип окна обратного звонка: 0 - без выбора дилерского центра, 1 - с выбором)
		*centers-list: Array (Список дилерских центров)
			{
				*name: 'Первый',
				*address: 'Москва, улица Новый Арбат д. 21, ст. 1',
				*coordinates: [58.578123, 49.607352],
				phones: ['777-777','888-888'],
				stations: ['Смоленская (400 м)', 'Курская (400 м)'],
				time: 'ежедневно, с 10:00 до 22:00'
			}
		*url-call-back: String (URL для отправки формы обратного звонка)

		* - обязательные параметры 
	-->
	<dealer-about :from-hour="10" :to-hour="18" :type="1" :centers-list="[
		{
			name: 'Первый',
			address: 'Москва, улица Новый Арбат д. 21, ст. 1',
			coordinates: [58.578123, 49.607352],
			phones: ['777-777','888-888'],
		},
		{
			name: 'Второй',
			address: 'Москва, улица Старый Арбат д. 21, ст. 1',
			coordinates: [58.603710, 49.656124],
			phones: ['999-999'],
			stations: ['Смоленская (900 м)', 'Курская (700 м)'],
			time: 'ежедневно, с 10:00 до 23:00'
		}
	]" url-call-back="/"></dealer-about>
</div>

@endsection

@section('scripts')
	<script src="{{ mix('/dealer/js/lazypreview.js') }}"></script>
    <script src="{{ mix('/dealer/js/about/libs.js') }}"></script>
    <script src="{{ mix('/dealer/js/about/index.js') }}"></script>
@endsection
