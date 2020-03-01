@extends('layouts.master-dealer')

@section('pageTitle', $item->title)
@section('pageDescription', "Новости компании «Хендэ Мотор СНГ». {$item->title}. {$item->datePublic}")

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/news/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/news/news.css') }}">
@endsection

@section('content')
<section class="back">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/news" class="df-back-link">
                    Все новости
                    <svg>
                        <use xlink:href="#back-link"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="news-content">
    <div class="news-content__top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $item->title }}</h1>
                    <h2>{{ $item->datePublic }}</h2>
                    <img src="{{ $item->imgPath }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="news-content__bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $item->text !!}
                </div>
            </div>
        </div>
    </div>
    <div class="news-content__all">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="news-content__center">
                        <a href="/news" class="df-button">Все новости</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
    <script src="{{ mix('/js/news/libs.js') }}"></script>
    <script src="{{ mix('/js/news/news.js') }}"></script>
@endsection
