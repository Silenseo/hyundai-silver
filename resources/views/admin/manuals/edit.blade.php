@extends('admin.admin')

@section('pageTitle', 'Руководства и каталоги')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Руководства и каталоги {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.manuals.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('car_id', $item->car_id, ['values' => $cars, 'publicName' => 'Автомобиль']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('file', $item->getFileUrl(), ['publicName' => 'Файл']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('link', $item->link, ['placeholder' => 'Введите ссылку', 'publicName' => 'Ссылка']) }}
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
