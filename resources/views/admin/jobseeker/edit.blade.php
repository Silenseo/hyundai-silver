@extends('admin.admin')

@section('pageTitle', 'Motorstudio: мероприятия')

@section('sidebar')
@include('admin.sidebar.motorstudio')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Мероприятие {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.motorstudio_events.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_start_day', date('Y-m-d', $item->date_start), ['placeholder' => '', 'publicName' => 'Дата начала', 'type' => 'date']) }}
			{{ Form::adminInput('date_start_time', date('H:i', $item->date_start), ['placeholder' => '', 'publicName' => 'Время начала', 'type' => 'time']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_end_day', date('Y-m-d', $item->date_end), ['placeholder' => '', 'publicName' => 'Дата окончания', 'type' => 'date']) }}
			{{ Form::adminInput('date_end_time', date('H:i', $item->date_end), ['placeholder' => '', 'publicName' => 'Время окончания', 'type' => 'time']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('name_en', $item->name_en, ['placeholder' => 'Введите название', 'publicName' => 'Название (англ.)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('calendar_name', $item->calendar_name, ['placeholder' => 'Введите название в календаре', 'publicName' => 'Название в календаре']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('calendar_name_en', $item->calendar_name_en, ['placeholder' => 'Введите название в календаре', 'publicName' => 'Название в календаре (англ.)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('detail_picture', '', ['publicName' => 'Изображение для промо-блока']) }}
		</div>
		<div class="content__line">
			{{ Form::adminFile('preview_picture', '', ['publicName' => 'Изображение основное']) }}
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('text', $item->text, ['publicName' => 'Текст']) }}
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('text_en', $item->text_en, ['publicName' => 'Текст (англ.)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('max_reg', $item->max_reg, ['placeholder' => 'Введите значение', 'publicName' => 'Ограничение на количество регистраций (0 - без ограничений)']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('is_promow', $item->is_promo, ['id' => 'is_promo', 'publicName' => 'Промо-событие']) }}
			<p>
				Обращаем ваше внимание, что установка промо-события очистит аналогичную галочку в других событиях
			</p>
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('available', $item->available, ['id' => 'available', 'publicName' => 'Обязательная запись']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('repair', $item->repair, ['id' => 'repair', 'publicName' => 'Ремонтные работы']) }}
		</div>
		<div class="content__line">
			{{ Form::adminCheckbox('visible', $item->visible, ['id' => 'visible', 'publicName' => 'Показывается?']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection 
