@extends('admin.admin')

@section('pageTitle', 'Бренд-коллекция: продукция')

@section('sidebar')
@include('admin.sidebar.brandcollection')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Бренд-коллекция: продукция создание</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.brandcollection_products.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="content__line">
			{{ Form::adminDropdown('category_id', $item->category_id, ['values' => $categories, 'publicName' => 'Категории']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('tag_id', $item->tag_id, ['values' => $tags, 'publicName' => 'Теги фильтра']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('article', $item->article, ['placeholder' => 'Введите значение', 'publicName' => 'Артикул']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('price', $item->price, ['placeholder' => 'Введите значение', 'publicName' => 'Цена']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('image', '', ['publicName' => 'Изображение']) }}
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('description', $item->description, ['publicName' => 'Описание']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('size', $item->size, ['placeholder' => 'Введите значение', 'publicName' => 'Размер']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('material', $item->material, ['placeholder' => 'Введите значение', 'publicName' => 'Материал']) }}
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('specifications', $item->specifications, ['publicName' => 'Общие характеристики']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('sort', $item->sort ?? 50, ['placeholder' => 'Введите значение', 'publicName' => 'Порядок сортировки']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('is_active', $item->is_active, ['id' => 'is_active', 'publicName' => 'Видимость']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('is_new', $item->is_new, ['id' => 'is_new', 'publicName' => 'Новинка']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection 
