@extends('admin.admin')

@section('pageTitle', 'Спец. предложения')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Спец. предложения {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.special_offers.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('url', $item->url, ['placeholder' => 'Введите значение', 'publicName' => 'URL']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('type', $item->type, ['values' => ['Покупателям', 'Сервис', 'Трейд-ин'], 'publicName' => 'Тип спецпредложения']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('label_id', $item->label_id, ['values' => $labels, 'publicName' => 'Лейбл', 'placeholder' => 'Выберите лейбл']) }}
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('text', $item->text, ['placeholder' => 'Введите текст', 'publicName' => 'Текст']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('image_preview', $item->getImagePreviewUrl(), ['publicName' => 'Картинка анонса  (465 x 330 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('image_world', $item->getImageWorldUrl(), ['publicName' => 'Картинка для Мира Хендэ  (1920 x 530 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('banner', $item->getBannerUrl(), ['publicName' => 'Баннер (1504 x 545 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('banner_mobile', $item->getBannerMobileUrl(), ['publicName' => 'Баннер мобильный (640 x 800 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('banner_title', $item->banner_title, ['placeholder' => 'Введите значение', 'publicName' => 'Заголовок баннера']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('banner_subtitle', $item->banner_subtitle, ['placeholder' => 'Введите значение', 'publicName' => 'Подзаголовок баннера']) }}
		</div>
		<div class="content__line">
			<fieldset>
				<label class="label">Показывать заголовок на баннере</label>
				{{ Form::adminCheckbox('show_header', $item->show_header, ['id' => 'show_header', 'publicName' => 'Показывать заголовок на баннере']) }}
			</fieldset>
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('blue_show', $item->blue_show, ['id' => 'blue_show', 'publicName' => 'Показывать синюю плашку']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminDropdown('blue_row1_type', $item->blue_row1_type, ['values' => ['Просто текст', 'Текст + знак рубля', 'Текст + знак рубля в месяц', 'Текст + символ'], 'publicName' => 'Первая строка синей плашки']) }}
			{{ Form::adminInput('blue_row1_text', $item->blue_row1_text, ['placeholder' => 'Введите текст', 'publicName' => '&nbsp;']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminDropdown('blue_row2_type', $item->blue_row2_type, ['values' => ['Просто текст', 'Текст + знак рубля', 'Текст + знак рубля в месяц', 'Текст + символ'], 'publicName' => 'Вторая строка синей плашки']) }}
			{{ Form::adminInput('blue_row2_text', $item->blue_row2_text, ['placeholder' => 'Введите текст', 'publicName' => '&nbsp;']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminDropdown('blue_row3_type', $item->blue_row3_type, ['values' => ['Просто текст', 'Текст + знак рубля', 'Текст + знак рубля в месяц', 'Текст + символ'], 'publicName' => 'Третья строка синей плашки']) }}
			{{ Form::adminInput('blue_row3_text', $item->blue_row3_text, ['placeholder' => 'Введите текст', 'publicName' => '&nbsp;']) }}
		</div>
		<div class="">
		@foreach($cars as $car)
			<div class="content__line">
				{{ Form::adminCheckbox('car_selected[]', isset($cars_selected[$car->id]), ['id' => 'visible', 'publicName' => $car->name, 'value' => $car->id]) }}
			</div>
		@endforeach
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('disclaimer', $item->disclaimer, ['placeholder' => 'Введите значение', 'publicName' => 'Дисклеймеры']) }}
		</div>
		<div class="content__line">
			{{ Form::adminDropdown('button_type', $item->button_type, ['values' => ['Нет', 'Запись на сервис', 'Тест-драйв', 'Найти дилера'], 'publicName' => 'Тип кнопки']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('is_active', $item->is_active, ['id' => 'is_active', 'publicName' => 'Активность']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('sort', $item->sort  ?? 50, ['placeholder' => 'Введите значение', 'publicName' => 'Порядок']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_active_from_day', empty($item->active_from) ? '' : date('Y-m-d', strtotime($item->active_from)), ['placeholder' => '', 'publicName' => 'Начало активности', 'type' => 'date']) }}
			{{ Form::adminInput('date_active_from_time', empty($item->active_from) ? '' : date('H:i', strtotime($item->active_from)), ['placeholder' => '', 'publicName' => 'Время', 'type' => 'time']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_active_to_day', empty($item->active_to) ? '' : date('Y-m-d', strtotime($item->active_to)), ['placeholder' => '', 'publicName' => 'Окончание активности', 'type' => 'date']) }}
			{{ Form::adminInput('date_active_to_time', empty($item->active_to) ? '' : date('H:i', strtotime($item->active_to)), ['placeholder' => '', 'publicName' => 'Время', 'type' => 'time']) }}
		</div>
		<div class="content__line">
			<fieldset>
				<label class="label">Показывать горячие кнопки</label>
				{{ Form::adminCheckbox('show_quick_buttons', $item->show_quick_buttons, ['id' => 'show_quick_buttons', 'publicName' => 'Показывать горячие кнопки']) }}
			</fieldset>
		</div>
		<div class="content__line">
			{{ Form::adminFile('video_desktop', $item->getVideoDesktopUrl(), ['publicName' => 'Видео десктопное (mp4, 1760 x 650 px)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('video_mobile', $item->getVideoMobileUrl(), ['publicName' => 'Видео мобильное (mp4, 640 x 800 px)']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection
