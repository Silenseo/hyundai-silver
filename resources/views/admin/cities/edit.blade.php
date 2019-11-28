@extends('admin.admin')

@section('pageTitle', 'Города')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Город {{ $item->id }}</h2>
			</div>
		</caption>
	</table>
	<form method="post" action="{{ route('admin.cities.update', $item->id) }}">
		@method('PATCH')
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('name_en', $item->name_en, ['placeholder' => 'Введите название', 'publicName' => 'Название en']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('name_fi', $item->name_fi, ['placeholder' => 'Введите название', 'publicName' => 'Название fi']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('name_de', $item->name_de, ['placeholder' => 'Введите название', 'publicName' => 'Название de']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('longitude', $item->longitude, ['placeholder' => 'Введите значение', 'publicName' => 'Долгота']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('latitude', $item->latitude, ['placeholder' => 'Введите значение', 'publicName' => 'Широта']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('zoom', $item->zoom, ['placeholder' => 'Введите значение', 'publicName' => 'Масштаб']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('order', $item->order ?? 50, ['placeholder' => 'Введите значение', 'publicName' => 'Order']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection