@extends('admin.admin')

@section('pageTitle', 'Аксессуары')

@section('sidebar')
@include('admin.sidebar.accessories')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Аксессуары</h2>
				<a href="{{ route('admin.accessories_products.create') }}" class="button button--small button--iconed">
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
				<th data-sort-name="name">Название</th>
				<th data-sort-name="article">Артикул</th>
				<th data-sort-name="visible">Показывается</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					{{ Form::adminInput('search_id', (string)request()->get('search_id'), ['placeholder' => '']) }}
				</td>
				<td>
					{{ Form::adminInput('search_name', (string)request()->get('search_name'), ['placeholder' => '']) }}
				</td>
				<td>
					<div class="table__flex">
						<div class="table__text">
							{{ Form::adminInput('search_article', (string)request()->get('search_article'), ['placeholder' => '']) }}
						</div>
						<ul class="table__controls">
							<li>
								<a href="javascript:void(0);" class="table__link" id="table_search">Поиск</a>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			@foreach($items as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->article }}</td>
				<td>{{ $item->visible == 1 ? 'Да' : 'Нет' }}</td>
				<td>
					<div class="table__flex">
						<div class="table__text"></div>
						<ul class="table__controls">
							<li>
								<a href="{{ route('admin.accessories_products.show', $item->id) }}" class="table__link">Изменить</a>
							</li>
							<li>
								<form method="post" action="{{ route('admin.accessories_products.destroy', $item->id) }}">
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