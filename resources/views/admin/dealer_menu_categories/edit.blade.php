@extends('admin.admin')

@section('pageTitle', 'РДилерское меню - категории')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Дилерское меню - категории {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.dealer_menu_categories.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('sort', $item->sort ?? 50, ['placeholder' => 'Введите значение', 'publicName' => 'Порядок сортировки']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('active', $item->active, ['id' => 'active', 'publicName' => 'Видимость']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('code', $item->code, ['placeholder' => 'Введите значение', 'publicName' => 'Код категории']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection 
