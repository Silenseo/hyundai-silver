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
		name: 'en',
	    monthArr: ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'],
	    monthArrNum: ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'],
	    register: 'Register',
	    registration: 'Registration'
    }

    var itemsJson = <?=$items ?>;

	//Временное расположение событий
/*
    var itemsJson = [
        {
            id: 0,
			available: false,
			promo: false,
            name: 'Выставка "Future Humanity - Our Shared Planet"',
			description: 'Данная экспозиция является частью глобальной выставки, представленной Hyundai Motor Company в Hyundai Motorstudio в Пекине, Сеуле и Москве. Организаторами и кураторами совместно выступают центр Ars Electronica и Hyundai Motor Company. Мы являемся свидетелями перехода из эры, в которую мы управляли машинами, в новую эру, где машины станут частью нашей жизни. Так какое же влияние техника оказывает на нас, и какое влияние мы оказываем на технику? Данная выставка дает ответы на подобные вопросы. Ждем вас в Hyundai Motorstudio Moscow.',
			from: '2019-02-06',
            to: '2019-02-15',
			img: '/images/motorstudio/events/1.jpg'
        },
        {
            id: 1,
			available: true,
			promo: true,
            name: 'Выставка "Future Humanity - Our Shared Planet"',
			description: 'Данная экспозиция является частью глобальной выставки, представленной Hyundai Motor Company в Hyundai Motorstudio в Пекине, Сеуле и Москве. Организаторами и кураторами совместно выступают центр Ars Electronica и Hyundai Motor Company. Мы являемся свидетелями перехода из эры, в которую мы управляли машинами, в новую эру, где машины станут частью нашей жизни. Так какое же влияние техника оказывает на нас, и какое влияние мы оказываем на технику? Данная выставка дает ответы на подобные вопросы. Ждем вас в Hyundai Motorstudio Moscow.',
			from: '2019-03-01',
            to: '2019-03-10',
			img: '/images/motorstudio/events/1.jpg'
        },
        {
            id: 2,
            available: true,
			name: 'Интересное событие в конце зимы',
			description: 'Готова ли Россия к электромобилям и что представляет из себя электромобиль Hyundai IONIQ?',
            from: '2019-03-05',
            to: '2019-03-05',
            img: '/images/motorstudio/events/2.jpg'
        },
        {
            id: 3,
            available: true,
			name: '8 марта!',
			description: 'Готова ли Россия к электромобилям и что представляет из себя электромобиль Hyundai IONIQ?',
            from: '2019-03-08',
            to: '2019-03-08',
            img: '/images/motorstudio/events/3.jpg'
        },
        {
            id: 4,
            available: true,
			name: 'Интересное короткое событие в начале весны',
			description: 'Готова ли Россия к электромобилям и что представляет из себя электромобиль Hyundai IONIQ?',
            from: '2019-03-10',
            to: '2019-03-10',
            img: '/images/motorstudio/events/4.jpg'
        },
        {
            id: 5,
            available: true,
            name: 'Двенадцатое',
            from: '2019-03-12',
            to: '2019-03-12',
            img: '/images/motorstudio/events/5.jpg'
        },
        {
            id: 6,
            available: true,
            name: 'Тринадцатое',
            from: '2019-03-13',
            to: '2019-03-13',
            img: '/images/motorstudio/events/6.jpg'
        },
        {
            id: 7,
			available: true,
			altLong: true,
            name: '2 Коротких',
            from: '2019-03-13',
            to: '2019-03-13',
            img: '/images/motorstudio/events/1.jpg'
        },
        {
            id: 8,
			available: false,
            name: 'Конец марта',
            from: '2019-03-31',
            to: '2019-04-05',
            img: '/images/motorstudio/events/1.jpg'
        },
        {
            id: 9,
			available: false,
            name: 'Начало апреля',
            from: '2019-04-06',
            to: '2019-04-10',
            img: '/images/motorstudio/events/2.jpg'
        }
    ]
*/
</script>

<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner__center">
					<div class="banner__video">
						<video preload="preload" autoplay loop muted>
							<source src="/images/motorstudio/Hyundai_MotorStudio_v_Moskve_2.mp4" type="video/mp4">
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
							Innovative multi-format
							<br>brand area
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
	<motor-studio></motor-studio>
</div>

@endsection

@section('scripts')
    <script src="{{ mix('/js/motorstudio/libs.js') }}"></script>
    <script src="{{ mix('/js/motorstudio/motorstudio.js') }}"></script>
@endsection
