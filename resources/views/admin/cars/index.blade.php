@extends('admin.admin')

@section('pageTitle', 'Список автомобилей')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
<table class="table">
        <caption>
            <div class="table__flex table__flex--caption">
                <h2 class="h2">Список автомобилей</h2>
            <a href="{{ route('admin.cars.create') }}" class="button button--small button--iconed">
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
                <th data-sort-name="visible">Показывается</th>
                <th data-sort-name="is_old_model">Старая модель</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->visible == 1 ? 'Да' : 'Нет' }}</td>
                <td>{{ $car->is_old_model == 1 ? 'Да' : 'Нет' }}</td>
                <td>
                    <div class="table__flex">
                        <div class="table__text"></div>
                        <ul class="table__controls">
                            <li>
                                <a href="{{ route('admin.cars.edit', $car->id)}}" class="table__link">Изменить</a>
                            </li>
                            <li>
                                <form method="post" action="{{ route('admin.cars.destroy', $car->id) }}">
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
    {{ $cars->appends(request()->input())->links('admin.pagination') }}
@endsection