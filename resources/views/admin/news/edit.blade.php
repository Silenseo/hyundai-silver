@extends('admin.admin')

@section('pageTitle', 'Новости')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Новость {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.news.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line">
				{{ Form::adminInput('title', $item->title, ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
			</div>
	
			<div class="content__line">
				{{ Form::adminInput('url', $item->url, ['placeholder' => 'Введите URL', 'publicName' => 'url', 'required' => true]) }}
			</div>
	
			<div class="content__line">
				{{ Form::adminInput('date', $item->dateAdminFormat, ['placeholder' => 'Введите URL', 'publicName' => 'Дата публикации', 'type' => 'date']) }}
			</div>
	
			<div class="content__line">
				{{ Form::adminFile('img', $item->imgPath, ['publicName' => 'Картинка новости']) }}
			</div>
	
			<div class="content__line">
				{{ Form::adminInput('preview_text', $item->preview_text, ['placeholder' => 'Введите краткий анонс', 'publicName' => 'Анонс новости']) }}
			</div>
	
			
			<div class="content__line">
				{{ Form::adminTextarea('text', $item->text, ['placeholder' => 'Введите текст новости', 'publicName' => 'Текст новости']) }}
			</div>
	
			<div class="content__line">
				{{ Form::adminInput('meta_title', $item->meta_title, ['placeholder' => 'Введите Meta Title', 'publicName' => 'Meta Title']) }}
			</div>
	
			<div class="content__line">
				{{ Form::adminInput('meta_keywords', $item->meta_keywords, ['placeholder' => 'Введите Meta Keywords', 'publicName' => 'Meta Keywords']) }}
			</div>
	
			<div class="content__line">
				{{ Form::adminInput('meta_description', $item->meta_description, ['placeholder' => 'Введите Meta Description', 'publicName' => 'Meta Description']) }}
			</div>
	
			
			<div class="content__line">
					<fieldset>
							<label class="label">Настройки показа</label>
				{{ Form::adminCheckbox('visible',  $item->visible, ['id' => 'visible', 'publicName' => 'Показывается на сайте']) }}
					</fieldset>
			</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection