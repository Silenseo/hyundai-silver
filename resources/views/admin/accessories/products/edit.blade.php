@extends('admin.admin')

@section('pageTitle', 'Аксессуары')

@section('sidebar')
@include('admin.sidebar.accessories')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Аксессуар {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.accessories_products.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line">
			{{ Form::adminDropdown('category_id', $item->category_id, ['values' => $categories, 'publicName' => 'Категория']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('article', $item->article, ['placeholder' => 'Введите артикул', 'publicName' => 'Артикул']) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('price', $item->price, ['placeholder' => 'Введите цену', 'publicName' => 'Цена']) }}
		</div>
		
		<div class="content__line">
			{{ Form::adminFile('image', $item->imgPath, ['publicName' => 'Картинка']) }}
		</div>

		<div class="content__line">
			{{ Form::adminTextarea('specs', $item->specs, ['placeholder' => 'Введите характеристики', 'publicName' => 'Характеристики']) }}
		</div>

		<div class="content__line">
			{{ Form::adminTextarea('description', $item->description, ['placeholder' => 'Введите описание', 'publicName' => 'Описание']) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('order', $item->order ?? 50, ['placeholder' => 'Введите индекс сортировки', 'publicName' => 'Индекс сортировки']) }}
		</div>
		<div class="content__line">
				<fieldset>
						<label class="label">Настройки показа</label>
			{{ Form::adminCheckbox('visible', $item->visible, ['id' => 'visible', 'publicName' => 'Показывается на сайте']) }}
				</fieldset>
		</div>
		<div class="">
		@foreach($cars as $car)
			<div class="content__line content__line--2">
				{{ Form::adminCheckbox('car_selected[]', isset($cars_selected[$car->id]), ['id' => 'visible', 'publicName' => $car->name, 'value' => $car->id]) }}
				{{ Form::adminInput("car_price[$car->id]", $cars_selected[$car->id] ?? 0, ['placeholder' => 'Введите значение', 'publicName' => '']) }}
			</div>
		@endforeach
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection