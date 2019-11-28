@extends('layouts.master-dealer')

@section('pageTitle', 'Новости')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/news/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/news/news.css') }}">
@endsection

@section('content')
<section class="head">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="head__center">
                    <h1 class="head__title">Новости</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="filters">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="filters__center">
                    <div class="filters__search">
                        <div class="df-search-simple">
                            <input class="df-search-simple__body" type="text" id="key-words" name="key-words" autocomplete="off" placeholder="Ключевые слова">
                        </div>
                    </div>
                    <div class="filters__date">
                        <div class="df-datepicker-range">
                            <input class="df-datepicker-range__body" id="datepicker-range" name="date" type="text" autocomplete="off" placeholder="Выберите дату">
                        </div>
                    </div>
                    <div class="filters__button">
                        <button type="submit" class="df-button js-search-button" disabled>Искать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="body">
    <div class="container">
        <div class="row">
            @foreach($news as $item)
            <div class="col-lg-3 col-md-6">
                <a href="/news/{{ $item->url }}" class="news" aria-label="news title">
                    <div role="img" class="news__img" style="background-image: url({{ $item->imgPath }})"></div>
                    <div class="news__date">{{ $item->datePublic }}</div>
                    <div class="news__text">
                        {{ $item->title }}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="pagination">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pagination__center">
                    {{ $news->links('frontend.pagination') }}
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
