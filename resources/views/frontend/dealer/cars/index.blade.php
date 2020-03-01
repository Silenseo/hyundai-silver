@extends('layouts.master-dealer')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')
@section('pageDescription', 'Официальный сайт Hyundai: модели и актуальные цены, обзоры и фото автомобилей, новости, запись на тест-драйв. Спешите купить новый Hyundai!')

@section('styles')
	<link rel="stylesheet" href="{{ mix('/dealer/css/placeholder.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/cars/libs.css') }}">
@endsection

@section('content')

<div id="dealercars">
	<div v-if="!init">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@component('components/placeholder')@endcomponent
				</div>
			</div>
		</div>
	</div>
	<dealer-cars v-else></dealer-cars>
</div>

<script>
//Тестовые данные
var carsList = [
	{
		id: 0,                    //* Number
		configId: 27,             //Number, если это св-во не указано, характеристики не будут подгружаться
		relevance: 0,             //* Number (Для сортировки по актуальности)
		date: '2019-08-12',       //* String Строка даты для парсинга js (ГГГГ-ММ-ДД)
		name: 'Elantra',          //* String
		year: 2019,               //* Number
		age: 'new',               //* String (new, old)
		oldPrice: 2000000,        //Number (перечёркнутая цена на странице авто)
		minPrice: 1750000,        //*Number (указывается на странице авто)
		maxPrice: 1850000,        //Number (опционально, на странице авто указывается минимальная цена)
		monthPayment: 7000,       //*Number (ежемесячный платёж)
		complectation: 'Travel',  //String
		type: 'Седан',            //*String
		seats: '5',               //*String
		doors: '4 дв.',           //String
		gearBox: 'Автоматическая',//*String
		engine: 'Бензиновый',     //*String
		engineV: '1.6',           //*String
		power: '123 л.с.',        //*String
		fuel: 'бензин',           //String
		transmission: 'Передний', //*String
		exteriorColor: 'Серый',   //*String
		interiorColor: 'Черный',  //*String
		interiorType: 'Ткань',    //*String
		milleage: 0,              //*Number
		vin: 'Z94CT41D*FR****17', //*String
		images: ['/images/cars/i30n/slider/1.jpg', '/images/cars/i30n/slider/2.jpg', '/images/cars/i30n/slider/3.jpg', '/images/cars/i30n/slider/4.jpg', '/images/cars/i30n/slider/5.jpg'],//*Array
		previewImages: ['/images/cars/i30n/slider/1.jpg', '/images/cars/i30n/slider/2.jpg', '/images/cars/i30n/slider/3.jpg', '/images/cars/i30n/slider/4.jpg']//Array (Превью меньшего разрешения для страницы со списком, если св-во отсутствует, то будут показаны обычные картинки)
	},
	{
		id: 1,
		relevance: 10,
		date: '2019-08-15',
		name: 'Tucson',
		year: 2018,
		age: 'old',
		oldPrice: 0,
		minPrice: 750000,
		maxPrice: 0,
		monthPayment: 6000,
		type: 'Кроссовер',
		seats: '7',
		doors: '5 дв.',
		gearBox: 'Механика',
		engine: 'Дизельный',
		engineV: '2.6',
		power: '223 л.с.',
		transmission: 'Полный',
		exteriorColor: 'Красный',
		interiorColor: 'Белый',
		interiorType: 'Кожа',
		milleage: 18000,
		vin: 'Z94CT41D*FR****19',
		images: ['/images/tmp/Tucson.jpg', '/images/cars/i30n/slider/2.jpg']
	},
	{
		id: 2,
		configId: 23,
		relevance: 5,
		date: '2019-08-02',
		name: 'Solaris',
		year: 2017,
		age: 'old',
		oldPrice: 0,
		minPrice: 550000,
		maxPrice: 0,
		monthPayment: 5000,
		type: 'Седан',
		seats: '7',
		doors: '5 дв.',
		gearBox: 'Автоматическая',
		engine: 'Бензиновый',
		engineV: '2.6',
		power: '115 л.с.',
		transmission: 'Передний',
		exteriorColor: 'Оранжевый',
		interiorColor: 'Фиолетовый',
		interiorType: 'Кожа',
		milleage: 10000,
		vin: 'Z94CT41D*FR****19',
		images: ['/images/cars/i30n/slider/1.jpg']
	},
	{
		id: 3,
		relevance: 5,
		date: '2019-08-02',
		name: 'Creta',
		year: 2017,
		age: 'old',
		oldPrice: 0,
		minPrice: 950000,
		maxPrice: 0,
		monthPayment: 5000,
		type: 'Кроссовер',
		seats: '5',
		doors: '5 дв.',
		gearBox: 'Автоматическая',
		engine: 'Бензиновый',
		engineV: '2.6',
		power: '223 л.с.',
		transmission: 'Полный',
		exteriorColor: 'Синий',
		interiorColor: 'Белый',
		interiorType: 'Кожа',
		milleage: 10000,
		vin: 'Z94CT41D*FR****19',
		images: ['/images/tmp/Tucson.jpg', '/images/cars/i30n/slider/2.jpg']
	},
	{
		id: 4,
		relevance: 5,
		date: '2019-07-02',
		name: 'SantaFe',
		year: 2007,
		age: 'old',
		oldPrice: 0,
		minPrice: 450000,
		maxPrice: 0,
		monthPayment: 5000,
		type: 'Кроссовер',
		seats: '5',
		doors: '5 дв.',
		gearBox: 'Автоматическая',
		engine: 'Бензиновый',
		engineV: '2.6',
		power: '223 л.с.',
		transmission: 'Полный',
		exteriorColor: 'Красный',
		interiorColor: 'Белый',
		interiorType: 'Кожа',
		milleage: 10000,
		vin: 'Z94CT41D*FR****19',
		images: ['/images/tmp/Tucson.jpg', '/images/cars/i30n/slider/2.jpg']
	}
]
</script>
@endsection

@section('scripts')
    <script src="{{ mix('/dealer/js/cars/libs.js') }}"></script>
    <script src="{{ mix('/dealer/js/cars/index.js') }}"></script>
@endsection
