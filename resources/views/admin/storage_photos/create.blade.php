@extends('admin.admin')

@section('pageTitle', 'Фото')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Фото создание</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.storage_photos.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="content__line">
			{{ Form::adminFile('file', '', ['publicName' => 'Фото']) }}
		</div>
		<div class="content__line">
			<button class="button button--large" type="submit">Сохранить</button>
			<button class="button button--large button--grey">Отменить</button>
		</div>
	</form>
@endsection
