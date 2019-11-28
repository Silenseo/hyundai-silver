@extends('admin.admin')

@section('pageTitle', 'Siebel logs')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Siebel logs</h2>
			</div>
		</caption>
		<thead>
			<tr>
				<th data-sort-name="id">id</th>
				<th data-sort-name="type">type</th>
				<th data-sort-name="logId">logId</th>
				<th data-sort-name="created_at">created_at</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ $item->type }}</td>
				<td>{{ $item->logId }}</td>
				<td>{{ $item->created_at }}</td>
				<td>
					<div class="table__flex">
						<ul class="table__controls">
							<li>
								<a href="{{ route('admin.siebel_logs.show', $item->id) }}" class="table__link">смотреть</a>
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