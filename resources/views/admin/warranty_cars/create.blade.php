@extends('admin.admin')

@section('pageTitle', 'Гарантии на автомобили')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Гарантия на автомобили создание</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.warranty_cars.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('period', $item->period, ['placeholder' => 'Введите значение', 'publicName' => 'Срок']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('mileage', $item->mileage, ['placeholder' => 'Введите значение', 'publicName' => 'Пробег']) }}
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('description', $item->description, ['publicName' => 'Описание']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('car_id', $item->car_id, ['values' => $cars, 'publicName' => 'Автомобиль']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('sort', $item->sort ?? 50, ['placeholder' => 'Введите значение', 'publicName' => 'Порядок сортировки']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('is_active', $item->is_active, ['id' => 'is_active', 'publicName' => 'Видимость']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection 
