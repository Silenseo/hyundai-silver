@extends('admin.admin')

@section('pageTitle', 'Бренд-коллекция: продукция')

@section('sidebar')
@include('admin.sidebar.brandcollection')
@endsection

@section('content')
	<table class="table">
		<caption>
			<div class="table__flex table__flex--caption">
				<h2 class="h2">Бренд-коллекция: продукция</h2>
				<a href="{{ route('admin.brandcollection_products.create') }}" class="button button--small button--iconed">
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
				<th data-sort-name="article">Артикул</th>
				<th data-sort-name="name">Название</th>
				<th data-sort-name="category__name">Категория</th>
				<th data-sort-name="tag__name">Тег фильтра</th>
				<th data-sort-name="price">Цена</th>
				<th data-sort-name="sort">Порядок</th>
				<th data-sort-name="is_active">Видимость</th>
				<th data-sort-name="is_new">Новинка</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ $item->article }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ @$item->category->name }}</td>
				<td>{{ @$item->tag->name }}</td>
				<td>{{ $item->price }}</td>
				<td>{{ $item->sort }}</td>
				<td>{{ $item->is_active > 0 ? 'Виден' : 'Скрыт' }}</td>
				<td>{{ $item->is_new > 0 ? '+' : '' }}</td>
				<td>
					<div class="table__flex">
						<ul class="table__controls">
							<li>
								<a href="{{ route('admin.brandcollection_products.show', $item->id) }}" class="table__link">Изменить</a>
							</li>
							<li>
								<form method="post" action="{{ route('admin.brandcollection_products.destroy', $item->id) }}">
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
