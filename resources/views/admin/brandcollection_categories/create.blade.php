@extends('admin.admin')

@section('pageTitle', 'Бренд-коллекция: категории')

@section('sidebar')
@include('admin.sidebar.brandcollection')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Бренд-коллекция: категория создание</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.brandcollection_categories.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('code', $item->code, ['placeholder' => 'Введите код', 'publicName' => 'Код']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('sort', $item->sort ?? 50, ['placeholder' => 'Введите значение', 'publicName' => 'Позиция']) }}
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
