@extends('admin.admin')

@section('pageTitle', 'Motorstudio: заявки')

@section('sidebar')
@include('admin.sidebar.motorstudio')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Motorstudio: заявки</h2>
				<a href="{{ route('admin.motorstudio_requests.download') }}" class="button button--small button--iconed">
					<span>
					</span>
					Скачать
				</a>
			</div>
		</caption>
		<thead>
			<tr>
				<th data-sort-name="id">id</th>
				<th data-sort-name="date">Дата</th>
				<th data-sort-name="event__name">Событие</th>
				<th data-sort-name="sirname">Фамилия</th>
				<th data-sort-name="name">Имя</th>
				<th data-sort-name="age">Возраст</th>
				<th data-sort-name="email">E-Mail</th>
				<th data-sort-name="phone">Телефон</th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ date('d.m.Y H:i', $item->date) }}</td>
				<td>{{ @$item->event->name }}</td>
				<td>{{ $item->sirname }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->age }}</td>
				<td>{{ $item->email }}</td>
				<td>{{ $item->phone }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $items->appends(request()->input())->links('admin.pagination') }}
@endsection
