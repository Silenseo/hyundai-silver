@extends('admin.admin')

@section('pageTitle', 'Редактировать плейсхолдер')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
  <h2 class="h2">Добавить плейсхолдер</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('admin.placeholders.update', $placeholder->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

        <div class="content__line">
                {{ Form::adminInput('code', $placeholder->code, ['placeholder' => 'Введите код блока', 'publicName' => 'Код блока', 'required' => true]) }}
        </div>

        <div class="content__line">
                {{ Form::adminInput('type', $placeholder->type, ['placeholder' => 'Введите описание блока', 'publicName' => 'Описание']) }}
        </div>

        <div class="content__line">
                {{ Form::adminInput('text', $placeholder->text, ['placeholder' => 'Введите текст', 'publicName' => 'Текст']) }}
        </div>

        <div class="content__line">
          {{ Form::adminFile('image', '', ['publicName' => 'Файл / Изображение']) }}
        </div>

          <div class="content__line">
              <button class="button button--large" type="submit">Сохранить</button>
              <button class="button button--large button--grey">Отменить</button>
            </div>
      </form>
@endsection
