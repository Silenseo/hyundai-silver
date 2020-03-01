@extends('admin.admin')

@section('pageTitle', 'Редактировать SEO-запись')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
  <h2 class="h2">Редактировать SEO-запись</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('admin.seo.update', $seo->id) }}">
          @csrf
          @method('PATCH')
          
        <div class="content__line">
                {{ Form::adminInput('url', $seo->url, ['placeholder' => 'Введите URL страницы', 'publicName' => 'URL страницы', 'required' => true]) }}
        </div>

        <div class="content__line content__line--3">
          {{ Form::adminInput('meta_title', $seo->meta_title, ['placeholder' => 'Введите Title', 'publicName' => 'Meta Title']) }}
          {{ Form::adminInput('meta_keywords', $seo->meta_keywords, ['placeholder' => 'Введите Keywords', 'publicName' => 'Meta Keywords']) }}
          {{ Form::adminInput('meta_description', $seo->meta_description, ['placeholder' => 'Введите Description', 'publicName' => 'Meta Description']) }}
        </div>
        
        <div class="content__line">
                {{ Form::adminInput('og_title', $seo->og_title, ['placeholder' => 'Введите og:title', 'publicName' => 'og:title']) }}
        </div>

        <div class="content__line">
                {{ Form::adminInput('og_image', $seo->og_image, ['placeholder' => 'Введите og:image', 'publicName' => 'og:image']) }}
        </div>

        <div class="content__line">
                {{ Form::adminInput('og_description', $seo->og_description, ['placeholder' => 'Введите og:description', 'publicName' => 'og:description']) }}
        </div>

        <div class="content__line">
          <button class="button button--large" type="submit">Сохранить</button>
          <button class="button button--large button--grey">Отменить</button>
        </div>
      </form>
@endsection