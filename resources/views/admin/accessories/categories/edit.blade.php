@extends('admin.admin')

@section('pageTitle', 'Аксессуары - категории')

@section('sidebar')
@include('admin.sidebar.accessories')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Категория {{ $item->id }}</h2>
			</div>
		</caption>
	</table>
	<form method="post" action="{{ route('admin.accessories_categories.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('subtitle', $item->subtitle, ['placeholder' => 'Введите подзаголовок', 'publicName' => 'Подзаголовок']) }}
		</div>
		
		<div class="content__line">
			{{ Form::adminFile('image', $item->imgPath, ['publicName' => 'Картинка']) }}
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
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection