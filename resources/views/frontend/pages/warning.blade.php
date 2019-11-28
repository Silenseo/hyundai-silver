@extends('layouts.master-dealer')

@section('pageTitle', 'Warning')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/warning.css') }}">
@endsection

@section('content')

<section class="service">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="service-inner">
          <div class="service-left">
            <img src="/images/service/bodyworks/fix.svg" alt="" class="service__img">
            <div class="service-block">
              <h3 class="service-title">
                @if(isset($message))
                {{ $message }}
                @else
                Мы исправляем ошибку сервера, чтобы сайт работал без перебоев.<br>Вернитесь на страницу через 15&nbsp;минут.<br>Спасибо.
                @endif
              </h3>
              <a href="/" class="service-link">На главную.</a>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
@endsection
