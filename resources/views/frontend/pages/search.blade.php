@extends('layouts.master')

@section('pageTitle', 'Результаты поиска')

@section('styles')
  <link rel="stylesheet" href="{{ mix('/css/search.css') }}">
@endsection

@section('content')

<section class="search">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="search-inner">
        <form action="/search">
          <div class="search-field-block">

            <input type="text" class="search_input" name="q" placeholder="" value="{{ $searchQuery }}">
            <svg role="img" aria-hidden="true" class="icon-magnifier">
              <use xlink:href="#icon-search"></use>
            </svg>
          </div>
          </form>
          <div class="search-body">
            <div class="search-title">
              @if(!empty($searchMessage))
              {{ $searchMessage }}
              @endif
              @if(count($searchResults) > 0)
              Найдено <span class="search-find-counter">{{ count($searchResults) }}</span> результат(ы) для <span class="search-request">«{{ $searchQuery }}»</span>
              @endif
            </div>
            @foreach($searchResults as $searchItem)
            <div class="search-item">
              <a href="{{ $searchItem['url'] }}">
                <div class="search-item-inner">
                  @if(!empty($searchItem['img']))
                  <div class="search-item-pic">
                    <img src="{{ $searchItem['img'] }}" alt="" class="search-pic__img">
                  </div>
                  @endif
                  <div class="search-item-content">
                    <div class="search-item-header">
                      <span class="search-item-section">{{ $searchItem['type'] }}</span>
                      @if(isset($searchItem['date']))
                      <p class="search-item-date">&nbsp;|&nbsp;<span class="search-date">{{ $searchItem['date'] }}</span></p>
                      @endif
                    </div>
                    <div class="search-item-text">
                      {{ $searchItem['title'] }}
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
            {{--
            <div class="df-button">
              Показать больше
            </div>
            --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
  <script src="{{ mix('/js/search/search.js') }}"></script>
@endsection
