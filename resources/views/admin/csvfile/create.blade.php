@extends('admin.admin')

@section('pageTitle', 'Добавить csv')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
  <h2 class="h2">Добавить csv</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div><br />
  @endif
  <form method="post" action="{{ route('admin.csvfile.store') }}" enctype="multipart/form-data">
      @csrf

    <div class="content__line content__line--3">
      {{ Form::adminInput('name', '', ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
    </div>

    <div class="content__line content__line--3">
      {{ Form::adminInput('code', '', ['placeholder' => 'Введите код', 'publicName' => 'Код', 'required' => true]) }}
    </div>

    <div class="content__line">
      {{ Form::adminFile('file', '', ['publicName' => 'Файл']) }}
    </div>

    <div class="content__line">
      <button class="button button--large" type="submit">Сохранить</button>
      <a href="{{ route('admin.csvfile.index') }}" class="button button--large button--grey">Отменить</a>
    </div>
  </form>
@endsection