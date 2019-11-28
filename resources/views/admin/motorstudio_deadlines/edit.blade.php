@extends('admin.admin')

@section('pageTitle', 'Motorstudio: даты закрытия')

@section('sidebar')
@include('admin.sidebar.motorstudio')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Дата закрытия {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.motorstudio_deadlines.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_closed_from_day', empty($item->closed_from) ? '' : date('Y-m-d', strtotime($item->closed_from)), ['placeholder' => '', 'publicName' => 'Закрыто с', 'type' => 'date']) }}
			{{ Form::adminInput('date_closed_from_time', empty($item->closed_from) ? '' : date('H:i', strtotime($item->closed_from)), ['placeholder' => '', 'publicName' => 'Время', 'type' => 'time']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_closed_to_day', empty($item->closed_to) ? '' : date('Y-m-d', strtotime($item->closed_to)), ['placeholder' => '', 'publicName' => 'Закрыто по', 'type' => 'date']) }}
			{{ Form::adminInput('date_closed_to_time', empty($item->closed_to) ? '' : date('H:i', strtotime($item->closed_to)), ['placeholder' => '', 'publicName' => 'Время', 'type' => 'time']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_show_from_day', empty($item->show_from) ? '' : date('Y-m-d', strtotime($item->show_from)), ['placeholder' => '', 'publicName' => 'Показывать с', 'type' => 'date']) }}
			{{ Form::adminInput('date_show_from_time', empty($item->show_from) ? '' : date('H:i', strtotime($item->show_from)), ['placeholder' => '', 'publicName' => 'Время', 'type' => 'time']) }}
		</div>
		<div class="content__line content__line--2">
			{{ Form::adminInput('date_show_to_day', empty($item->show_to) ? '' : date('Y-m-d', strtotime($item->show_to)), ['placeholder' => '', 'publicName' => 'Показывать по', 'type' => 'date']) }}
			{{ Form::adminInput('date_show_to_time', empty($item->show_to) ? '' : date('H:i', strtotime($item->show_to)), ['placeholder' => '', 'publicName' => 'Время', 'type' => 'time']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('reason', $item->reason, ['placeholder' => 'Введите причину', 'publicName' => 'Причина']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection 
