@extends('admin.admin')

@section('pageTitle', 'Motorstudio: даты закрытия')

@section('sidebar')
@include('admin.sidebar.motorstudio')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Motorstudio: даты закрытия</h2>
				<a href="{{ route('admin.motorstudio_deadlines.create') }}" class="button button--small button--iconed">
					<span>
						<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="3" width="2" height="8" fill="white" />
							<rect x="8" y="3" width="2" height="8" transform="rotate(90 8 3)" fill="white" />
						</svg>
					</span>
					Добавить
				</a>
			</div>
		</caption>
		<thead>
			<tr>
				<th data-sort-name="id">id</th>
				<th data-sort-name="closed_from">Закрыто с</th>
				<th data-sort-name="closed_to">Закрыто по</th>
				<th data-sort-name="show_from">Показывать с</th>
				<th data-sort-name="show_to">Показывать по</th>
				<th data-sort-name="reason">Причина</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ empty($item->closed_from) ? '' : date('d.m.Y H:i', strtotime($item->closed_from)) }}</td>
				<td>{{ empty($item->closed_to) ? '' : date('d.m.Y H:i', strtotime($item->closed_to)) }}</td>
				<td>{{ empty($item->show_from) ? '' : date('d.m.Y H:i', strtotime($item->show_from)) }}</td>
				<td>{{ empty($item->show_to) ? '' : date('d.m.Y H:i', strtotime($item->show_to)) }}</td>
				<td>{{ $item->reason }}</td>
				<td>
					<div class="table__flex">
						<ul class="table__controls">
							<li>
								<a href="{{ route('admin.motorstudio_deadlines.show', $item->id) }}" class="table__link">Изменить</a>
							</li>
							<li>
								<form method="post" action="{{ route('admin.motorstudio_deadlines.destroy', $item->id) }}">
									@method('DELETE')
									@csrf
									<a href="javascript:void(0);" class="table__link" onclick="$(this).closest('form').submit();">Удалить</a>
								</form>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $items->appends(request()->input())->links('admin.pagination') }}
@endsection