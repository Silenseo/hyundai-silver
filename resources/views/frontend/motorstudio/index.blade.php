@extends('layouts.master')

@section('pageTitle', 'Motorstudio')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/motorstudio/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/motorstudio/motorstudio.css') }}">
@endsection

@section('content')

@component('components/plugin-map')@endcomponent

<script>
	var lang = {
		name: 'ru',
	    monthArr: ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'],
	    monthArrNum: ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
	    register: 'Записаться',
	    registration: 'Записаться'
	}

	//Временное расположение событий

	var itemsJson = <?=$items ?>;
	var popupData = <?=$popupData ?>;

	//Событие для тестов
	var testEvent = [{
            id: 54654884,
			available: true,
			promo: false,
            name: 'Выставка "Future Humanity - Our Shared Planet"',
			description: 'Данная экспозиция является частью глобальной выставки, представленной Hyundai Motor Company в Hyundai Motorstudio в Пекине, Сеуле и Москве. Организаторами и кураторами совместно выступают центр Ars Electronica и Hyundai Motor Company. Мы являемся свидетелями перехода из эры, в которую мы управляли машинами, в новую эру, где машины станут частью нашей жизни. Так какое же влияние техника оказывает на нас, и какое влияние мы оказываем на технику? Данная выставка дает ответы на подобные вопросы. Ждем вас в Hyundai Motorstudio Moscow.',
			from: '2019-02-06',
            to: '2019-02-15',
			img: '/images/motorstudio/events/1.jpg'
        }]


    // var itemsJson = [
    //     {
    //         id: 8,
	// 		available: true,
	// 		name: 'Конец марта',
	// 		calendar_name: 'Конец марта',
    //         from: '2019-11-05',
    //         to: '2019-11-05',
    //         img: '/images/motorstudio/events/7.jpg',
    //         img_mobile: '/images/motorstudio/events/7.1.jpg'
    //     },
    //     {
    //         id: 119,
	// 		available: true,
	// 		altLong: true,
	// 		name: 'Начало апреля',
	// 		calendar_name: 'Начало апреля',
    //         from: '2019-11-05',
    //         to: '2019-11-05',
	// 		img: '/images/motorstudio/events/2.jpg',
	// 		img_mobile: '/images/motorstudio/events/7.1.jpg'
    //     }
    // ]


</script>

<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner__center">
					<div class="banner__video">
						<video preload="preload" autoplay loop muted data-object-fit="cover">
							<source src="/images/motorstudio/Hyundai_MotorStudio_v_Moskve_compressed.mp4" type="video/mp4">
						</video>
					</div>
					<div class="banner__composition">
						<h1 class="banner__title">
							<span>
								HYUNDAI
								<br>MOTORSTUDIO
							</span>
							<br>
							MOSCOW
						</h1>
						<div class="banner__subtitle">
							Инновационное мультиформатное
							<br>бренд-пространство
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="app">
	<div v-if="!init">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@component('components/placeholder')@endcomponent
				</div>
			</div>
		</div>
	</div>
	<motor-studio v-else></motor-studio>
</div>

@endsection

@section('scripts')
    <script src="{{ mix('/js/motorstudio/libs.js') }}"></script>
    <script src="{{ mix('/js/motorstudio/motorstudio.js') }}"></script>
@endsection
