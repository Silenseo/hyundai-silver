@extends('admin.admin')

@section('pageTitle', 'Соискатели')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Соискатели</h2>
				<a href="{{ route('admin.jobseeker.download') }}" class="button button--small button--iconed">
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
				<td>{{ date('d.m.Y H:i', strtotime($item->created_at)) }}</td>
				<td>{{ $item->surname }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->patronymic }}</td>
				<td>{{ $item->email }}</td>
				<td>{{ $item->tel }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $items->appends(request()->input())->links('admin.pagination') }}
@endsection
