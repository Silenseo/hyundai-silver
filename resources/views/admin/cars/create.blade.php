@extends('admin.admin')

@section('pageTitle', 'Добавить автомобиль')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
  <h2 class="h2">Добавить автомобиль</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
          @csrf


        <div class="content__line content__line--3">
          {{ Form::adminInput('name', '', ['placeholder' => 'Введите название', 'publicName' => 'Название', 'required' => true]) }}
          {{ Form::adminInput('name_menu_rus', '', ['placeholder' => 'Введите русское название для меню', 'publicName' => 'Русское название для меню']) }}
          {{ Form::adminInput('name_menu_en', '', ['placeholder' => 'Введите английское название для меню', 'publicName' => 'Английское название для меню']) }}
        </div>

        <div class="content__line content__line--3">
          {{ Form::adminInput('id_text', '', ['placeholder' => 'Введите URL', 'publicName' => 'URL']) }}
          {{ Form::adminInput('price_min', '', ['placeholder' => 'Введите минимальную цену', 'publicName' => 'Минимальная цена']) }}
          {{ Form::adminInput('siebel_code', '', ['placeholder' => 'Введите код Siebel', 'publicName' => 'Код для Siebel']) }}
        </div>

        <div class="content__line content__line--3">
            {{ Form::adminInput('menu_row', '', ['placeholder' => 'Введите номер строки', 'publicName' => 'Строка в меню']) }}
            {{ Form::adminInput('menu_column', '', ['placeholder' => 'Введите номер столбца', 'publicName' => 'Столбец в меню']) }}
            {{ Form::adminInput('conf_id', '', ['placeholder' => 'Введите ID в конфигураторе', 'publicName' => 'ID в конфигураторе']) }}
          </div>

        <div class="content__line">
            {{ Form::adminFile('image', '', ['publicName' => 'Основное изображение (700 x 320 px)']) }}
        </div>

        <div class="content__line">
            {{ Form::adminFile('image_left_mp', '', ['publicName' => 'Изображение левое, для МП']) }}
        </div>

        <div class="content__line">
            {{ Form::adminFile('image_right_mp', '', ['publicName' => 'Изображение правое, для МП']) }}
        </div>

        <div class="content__line">
            {{ Form::adminFile('image_beauty_mp', '', ['publicName' => 'Изображение красивое, для МП']) }}
        </div>

        <div class="content__line">
            {{ Form::adminCheckbox('is_promo', 1, ['id' => 'is_promo', 'publicName' => 'Промо']) }}
        </div>
        <div class="content__line">
            <fieldset>
                <label class="label">Настройки показа</label>
            {{ Form::adminCheckbox('visible', 1, ['id' => 'visible', 'publicName' => 'Показывается на сайте']) }}
            </fieldset>
        </div>

        <div class="content__line">
          {{ Form::adminCheckbox('is_old_model', 0, ['id' => 'is_old_model', 'publicName' => 'Старая модель']) }}
        </div>

        <div class="content__line">
          {{ Form::adminInput('tradein', '', ['placeholder' => 'Введите значение', 'publicName' => 'Размер скидки по Trade-In']) }}
        </div>

          <div class="content__line">
              <button class="button button--large" type="submit">Сохранить</button>
            <button href="{{ route('admin.cars.index') }}" class="button button--large button--grey">Отменить</button>
            </div>
      </form>
@endsection
