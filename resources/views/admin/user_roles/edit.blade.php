@extends('admin.admin')

@section('pageTitle', 'Редактировать группу пользователей')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
  <h2 class="h2">Редактировать группу пользователей</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('admin.user_roles.update', $item->id) }}">
          @csrf
          @method('PATCH')
          <div class="content__line">
              {{ Form::adminInput('name', $item->name, ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
          </div>
          <div class="content__line">
              {{ Form::adminInput('code', $item->code, ['placeholder' => 'Введите код', 'publicName' => 'Код', 'required' => true]) }}
          </div>
          <div class="">
            <div>Права доступа:</div>
            @foreach($permissions as $permission)
              {{ Form::adminCheckbox('permissions_selected[]', isset($permissions_selected[$permission->id]), ['id' => 'visible', 'publicName' => $permission->name, 'value' => $permission->id]) }}
            @endforeach
          </div>
          <div class="content__line">
              <button class="button button--large" type="submit">Сохранить</button>
              <button class="button button--large button--grey">Отменить</button>
            </div>
      </form>
@endsection