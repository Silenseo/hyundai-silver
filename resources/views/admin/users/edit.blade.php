@extends('admin.admin')

@section('pageTitle', 'Редактировать пользователя')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
  <h2 class="h2">Редактировать пользователя</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('admin.users.update', $user->id) }}">
          @csrf
          @method('PATCH')
          
          <div class="content__line">
            {{ Form::adminInput('name', $user->name, ['placeholder' => 'Введите имя пользователя', 'publicName' => 'Имя пользователя', 'required' => true]) }}
        </div>

        <div class="content__line">
            {{ Form::adminInput('email', $user->email, ['placeholder' => 'Введите E-Mail', 'publicName' => 'E-Mail', 'required' => true]) }}
        </div>

        <div class="content__line">
            {{ Form::adminInput('password', '', ['placeholder' => 'Введите пароль', 'publicName' => 'Пароль', 'type' => 'password']) }}
        </div>

        <div class="">
          @foreach($roles as $role)
            <div class="content__line">
              {{ Form::adminCheckbox('roles_selected[]', isset($roles_selected[$role->id]), ['id' => 'visible', 'publicName' => $role->name, 'value' => $role->id]) }}
            </div>
          @endforeach
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