@extends('admin.admin')

@section('pageTitle', 'Баннеры')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Баннер создание</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('title', $item->title, ['placeholder' => 'Введите текст заголовка', 'publicName' => 'Текст заголовка']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('subtitle', $item->subtitle, ['placeholder' => 'Введите текст подзаголовка', 'publicName' => 'Текст подзаголовка']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('font_color', $item->font_color, ['values' => ['Белый', 'Черный'], 'publicName' => 'Цвет шрифта заголовка']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('blue_show', $item->blue_show, ['id' => 'blue_show', 'publicName' => 'Показывать синюю плашку']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminDropdown('row1_type', $item->row1_type, ['values' => ['Просто текст', 'Текст + знак рубля', 'Текст + знак рубля в месяц', 'Текст + символ'], 'publicName' => 'Первая строка синей плашки']) }}
			{{ Form::adminInput('blue_row1', $item->blue_row1, ['placeholder' => 'Введите текст', 'publicName' => '&nbsp;']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminDropdown('row2_type', $item->row2_type, ['values' => ['Просто текст', 'Текст + знак рубля', 'Текст + знак рубля в месяц', 'Текст + символ'], 'publicName' => 'Вторая строка синей плашки']) }}
			{{ Form::adminInput('blue_row2', $item->blue_row2, ['placeholder' => 'Введите текст', 'publicName' => '&nbsp;']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminDropdown('row3_type', $item->row3_type, ['values' => ['Просто текст', 'Текст + знак рубля', 'Текст + знак рубля в месяц', 'Текст + символ'], 'publicName' => 'Третья строка синей плашки']) }}
			{{ Form::adminInput('blue_row3', $item->blue_row3, ['placeholder' => 'Введите текст', 'publicName' => '&nbsp;']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('image', '', ['publicName' => 'Картинка основная (1760 x 650 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('image_mobile', '', ['publicName' => 'Картинка мобильная (640 x 800 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('video_desktop', '', ['publicName' => 'Видео десктопное (mp4, 1760 x 650 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('video_mobile', '', ['publicName' => 'Видео мобильное (mp4, 640 x 800 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('order', $item->order ?? 50, ['placeholder' => 'Введите индекс сортировки', 'publicName' => 'Индекс сортировки']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('link', $item->link, ['placeholder' => 'Введите адрес ссылки', 'publicName' => 'Ссылка на баннере']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('target', $item->target, ['values' => ['В этом же окне', 'В новом окне'], 'publicName' => 'Где открывать?']) }}
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
