@extends('layouts.master')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')

@section('styles')
    <link rel="stylesheet" href="/assets/ss/offers-style.css">
    <link rel="stylesheet" href="/assets/ss/ss.css">
@endsection

@section('content')
<div class="offers-container">
	<div class="content_area">
		<img class="promo-head lazyload" src="/getPicThumb/assets/ss/ss_2_bg.jpg?w=100&h=0" data-src="/assets/ss/ss_2_bg.jpg" style="">
		<img class="promo-head-mobile lazyload" src="/getPicThumb/assets/ss/ss_2_mob.jpg?w=100&h=0" width="640px" height="700px" data-src="/assets/ss/ss_2_mob.jpg" style="">

		<div class="offers-content">

			<h1 class="title-offer bordr-btm"><span class="nowrp">Уникальный SOLARIS Super Series II</span></h1>
<!-- 			<h2 class="title-offer bordr-btm"><span class="nowrp">Стартуй в лето!</span></h2> -->
		</div>
	</div>

	<div class="content_area cnt_grey">
		<div class="offers-content">
			<h1 class="title-offer bordr-btm"><span class="nowrp">Динамика<br/>превосходит ожидания!</span></h1>

			<div class="offer-terms bordr-btm">
				<div class="offers-block">
					<div class="row-inline">
						<div class="dyn_data">
						<div class="dyn_b1">
							Двигатель Gamma с рабочим объемом 1.6 л. И с механической/автоматической КПП на выбор.
						</div>
						<div class="dyn_b3">
							<div class="val">150.7 Нм</div>
							<div class="label">Крутящий момент</div>
						</div>
						<div class="dyn_b2">
							<div class="val">123 л.с.</div>
							<div class="label">Мощность</div>
						</div>

						</div>
						<div class="dyn_data">
							<div class="dyn_pic1"><img src="/assets/ss/kpp1.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/kpp2.png"/></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="content_area">
		<div class="offers-content">

			<h1 class="title-offer bordr-btm"><span class="nowrp">Особенности комплектации</span><img src="/assets/ss/ss.png"/><br/></h1>
			<h2 class="title-offer bordr-btm"><span class="nowrp">Интерьер</span></h2>

			<div class="offer-terms bordr-btm">
				<div class="offers-block">
					<div class="row-inline">
						<div class="dyn_data">
							<div class="dyn_pic1"><img src="/assets/ss/i1.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/i5.png"/></div>
							<!-- <div class="dyn_pic2"><img src="/assets/ss/i2.png"/></div> -->
						</div>

						<!-- <div class="dyn_data">
							<div class="dyn_pic1"><img src="/assets/ss/i3.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/i4.png"/></div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content_area cnt_grey">
		<div class="offers-content">
			<h1 class="title-offer bordr-btm"><span class="nowrp">Экстерьер</span></h1>

			<div class="offer-terms bordr-btm">
				<div class="offers-block">
					<div class="row-inline">
						<div class="dyn_data">
							<!-- <div class="dyn_pic1"><img src="/assets/ss/e1.png"/></div> -->
							<div class="dyn_pic1"><img src="/assets/ss/e5.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/e2.png"/></div>
						</div>

						<!-- <div class="dyn_data">
							<div class="dyn_pic1"><img src="/assets/ss/e3.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/e4.png"/></div>
						</div> -->

						<!-- <div class="dyn_data">
							<div class="dyn_pic1"><img src="/assets/ss/e5.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/e6.png"/></div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content_area">
		<div class="offers-content">
			<h1 class="title-offer bordr-btm"><span class="nowrp">Комфорт</span></h1>

			<div class="offer-terms bordr-btm">
				<div class="offers-block">
					<div class="row-inline">
						<div class="dyn_data">
							<div class="dyn_pic1"><img src="/assets/ss/k1.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/k2.png"/></div>
						</div>

						<!-- <div class="dyn_data">
							<div class="dyn_pic1"><img src="/assets/ss/k3.png"/></div>
							<div class="dyn_pic2"><img src="/assets/ss/k4.png"/></div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content_area">
		<div class="offers-content">
			<div class="offer-terms bordr-btm">
				<div class="offers-block">
					<br><br>
					<div class="mlr">
					<a href="/configurator/car/23" target="_blank" class="request-service-btn">Конфигуратор</a>   <a href="/test-drive/Solaris" target="_blank" class="inverse-service-btn">Тест-драйв</a>   <a href="/configurator/car/23#calculator" target="_blank" class="inverse-service-btn">Цены и сравнение</a>
					</div>
					<!-- additional terms as footer -->
					<div class="clearfix"></div>
					<!-- additional terms as footer -->
					<div class="clearfix"></div>
					<!--
					<div class="tip-supscript ">
						<p style="font-size: 10px;">
						* Выгода достигается путем перечисления официальным дилером Hyundai скидки от розничной цены автомобиля в сумме 47 000 (сорок семь тысяч) рублей, достаточной для погашения трех ежемесячных платежей по первоначальному графику платежей, на банковский счет заемщика, открытый в рамках Договора потребительского кредита по программе кредитования новых автомобилей Hyundai Solaris SE 2018, 2019 года выпуска - «Hyundai Finance Indirect – Летние платежи в подарок», продукт «АвтоСтиль-Особый». Срок кредита – от 24 до 36 мес.; первоначальный взнос – от 0% от цены приобретаемого автомобиля; процентная ставка – от 12,8% до 15,8% годовых; валюта кредита – рубли РФ. Программой предусмотрено подключение опции «Остаточный платеж» в размере от 50% до 60% от цены приобретаемого автомобиля и оформление договора страхования автомобиля от рисков хищения (угона), утраты (гибели). Процентная ставка 12,8% применяется при включении Заемщика в Программу добровольной финансовой и страховой защиты № 5, реализуемую Банком совместно с ООО СК «Согласие-Вита»/САО «ВСК». Минимальный пакет документов, необходимый для получения кредита: паспорт гражданина РФ. Залоговое обеспечение – залог приобретаемого автомобиля. Информация действительна на 01.06.2019 г. Программа осуществляется в сотрудничестве с ПАО «Совкомбанк». Генеральная лицензия Банка России № 963 от 05 декабря 2014 года. Не является публичной офертой.
						</p>
					</div>
					-->
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

</div>




@endsection

@section('scripts')
	<script src="/js/lazypreview.js"></script>
	<script src="/js/special/libs.js"></script>
@endsection
