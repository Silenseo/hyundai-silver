@extends('layouts.admin')

@section('content')

<h2 class="h2">Авторизация</h2>

<form method="post" action="{{ route('adminloginpost', [], false) }}">
      @csrf

      <div class="content__line content__line--3">
              {{ Form::adminInput('email', '', ['placeholder' => 'Введите E-Mail', 'publicName' => 'E-Mail', 'type' => 'email', 'required' => true]) }}
      </div>

      <div class="content__line content__line--3">
              {{ Form::adminInput('password', '', ['placeholder' => 'Введите пароль', 'publicName' => 'Пароль', 'type' => 'password', 'required' => true]) }}
      </div>

        <div class="content__line">
            <button class="button button--large" type="submit">Вход</button>
          </div>
    </form>

@endsection