@extends('admin.admin')

@section('pageTitle', 'Новости')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Добавить новость</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="content__line">
			{{ Form::adminInput('title', '', ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('url', '', ['placeholder' => 'Введите URL', 'publicName' => 'url', 'required' => true]) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('date', '', ['placeholder' => 'Введите URL', 'publicName' => 'Дата публикации', 'type' => 'date']) }}
		</div>

		<div class="content__line">
			{{ Form::adminFile('img', '', ['publicName' => 'Картинка новости']) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('preview_text', '', ['placeholder' => 'Введите краткий анонс', 'publicName' => 'Анонс новости']) }}
		</div>

		
		<div class="content__line">
			{{ Form::adminTextarea('text', '', ['placeholder' => 'Введите текст новости', 'publicName' => 'Текст новости']) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('meta_title', '', ['placeholder' => 'Введите Meta Title', 'publicName' => 'Meta Title']) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('meta_keywords', '', ['placeholder' => 'Введите Meta Keywords', 'publicName' => 'Meta Keywords']) }}
		</div>

		<div class="content__line">
			{{ Form::adminInput('meta_description', '', ['placeholder' => 'Введите Meta Description', 'publicName' => 'Meta Description']) }}
		</div>

		
		<div class="content__line">
			<fieldset>
				<label class="label">Настройки показа</label>
				{{ Form::adminCheckbox('visible',  '', ['id' => 'visible', 'publicName' => 'Показывается на сайте']) }}
			</fieldset>
		</div>
				
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection 
