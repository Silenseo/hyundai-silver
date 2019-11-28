@extends('admin.admin')

@section('pageTitle', 'Siebel logs')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Siebel logs {{ $item->id }}</h2>
			</div>
		</caption>
	</table>

	<form method="post" action="{{ route('admin.siebel_logs.update', $item->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="content__line">
			{{ Form::adminInput('type', $item->type, ['placeholder' => '', 'publicName' => 'Типtype']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('logId', $item->logId, ['placeholder' => '', 'publicName' => 'logId']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('source', $item->source, ['placeholder' => '', 'publicName' => 'source']) }}
		</div>
		<div class="content__line">
			{{ Form::adminInput('created_at', $item->created_at, ['placeholder' => '', 'publicName' => 'created_at']) }}
		</div>
		<div class="content__line">
			{{ Form::adminTextarea('data', json_encode(json_decode($item->data), JSON_PRETTY_PRINT), ['placeholder' => '', 'publicName' => 'data']) }}
		</div>
		<div class="content__line">
			<button class="button button--large button--grey" type="submit">Отменить</button>
		</div>
	</form>
@endsection
