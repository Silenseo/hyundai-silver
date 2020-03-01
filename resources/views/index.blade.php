@extends('layouts.master-dealer')

@section('pageTitle', 'Hyundai: модельный ряд, цены на автомобили, где купить Хендэ')
@section('pageDescription', 'Официальный сайт Hyundai: модели и актуальные цены, обзоры и фото автомобилей, новости, запись на тест-драйв. Спешите купить новый Hyundai!')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/index/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/index/index.css') }}">
@endsection

@section('content')
    <section class="slider lazyload lazypreview" data-bgset="/images/index/fon.jpg">
        <div class="container-fluid slider__wrap">
            <div class="row">
                <div class="col-md-12">
                    <ul class="slider__body js-main-slider owl-carousel">

                        @foreach($banners as $banner)
							@if($banner->isVideo())
								<li class="slider__item">
									<a id="start-link" class="slider__link" href="{{ $banner->link }}" {{ $banner->target == 1 || strpos($banner->link, '"//') !== false ? 'target="_blank"' : '' }} aria-label="{{ $banner->title }}">
										<div class="slider__video" data-desctop-video="{{ $banner->getVideoDesktopUrl() }}" data-mobile-video="{{ $banner->getVideoMobileUrl() }}"></div>
										@if($banner->font_color == 0)
										<div class="slider__inner">
											<h2 class="slider__title"><?=$banner->title?></h2>
											<div class="slider__subtitle df-banner-subline">{{ $banner->subtitle }}</div>
										</div>
										@else
										<div class="slider__inner">
											<h2 class="slider__title" style="color: #000;"><?=$banner->title?></h2>
											<div class="slider__subtitle df-banner-subline" style="color: #000;">{{ $banner->subtitle }}</div>
										</div>
										@endif
										@if($banner->blue_show == 1)
										<div class="blue-panel">
											<div class="blue-panel__inner">
												@if(strlen($banner->blue_row1) > 0)
													@if($banner->row1_type == 3)
														<div class="blue-panel__more">
															{{ $banner->blue_row1 }}
															<svg>
																<use xlink:href="#arrow-link"></use>
															</svg>
														</div>
													@else
														<div>
															{{ $banner->blue_row1 }}
															<?php
															switch($banner->row1_type) {
																case 1: { echo '&nbsp;₽'; break; }
																case 2: { echo '&nbsp;₽/мес.'; break; }
																//case 3: { echo '&nbsp;>'; break; }
															};
															?>
														</div>
													@endif
												@endif

												@if(strlen($banner->blue_row2) > 0)
													@if($banner->row2_type == 3)
														<div class="blue-panel__more">
															{{ $banner->blue_row2 }}
															<svg>
																<use xlink:href="#arrow-link"></use>
															</svg>
														</div>
													@else
														<div>
															{{ $banner->blue_row2 }}
															<?php
															switch($banner->row2_type) {
																case 1: { echo '&nbsp;₽'; break; }
																case 2: { echo '&nbsp;₽/мес.'; break; }
																//case 3: { echo '&nbsp;>'; break; }
															};
															?>
														</div>
													@endif
												@endif

												@if(strlen($banner->blue_row3) > 0)
													@if($banner->row3_type == 3)
														<div class="blue-panel__more">
															{{ $banner->blue_row3 }}
															<svg>
																<use xlink:href="#arrow-link"></use>
															</svg>
														</div>
													@else
														<div>
															{{ $banner->blue_row3 }}
															<?php
															switch($banner->row3_type) {
																case 1: { echo '&nbsp;₽'; break; }
																case 2: { echo '&nbsp;₽/мес.'; break; }
																//case 3: { echo '&nbsp;>'; break; }
															};
															?>
														</div>
													@endif
												@endif

												{{--
												<div>
													от 1 999 000 ₽
												</div>
												<div>
													КАСКО в подарок
												</div>
												<div class="blue-panel__more">
													Подробнее
													<svg>
														<use xlink:href="#arrow-link"></use>
													</svg>
												</div>
												--}}
											</div>
										</div>
										@endif
									</a>
								</li>
							@else
								<li class="slider__item lazyload lazypreview" data-bgset="{{ $banner->getImageMobileUrl() }} [(max-width: 640px)] | {{ $banner->getImageUrl() }}">
									<a class="slider__link" href="{{ $banner->link }}" {{ $banner->target == 1 || strpos($banner->link, '"//') !== false ? 'target="_blank"' : '' }} aria-label="{{ $banner->title }}">
										@if($banner->font_color == 0)
										<div class="slider__inner">
											<h2 class="slider__title"><?=$banner->title?></h2>
											<div class="slider__subtitle df-banner-subline">{{ $banner->subtitle }}</div>
										</div>
										@else
										<div class="slider__inner">
											<h2 class="slider__title" style="color: #000;"><?=$banner->title?></h2>
											<div class="slider__subtitle df-banner-subline" style="color: #000;">{{ $banner->subtitle }}</div>
										</div>
										@endif
										@if($banner->blue_show == 1)
										<div class="blue-panel">
											<div class="blue-panel__inner">
												@if(strlen($banner->blue_row1) > 0)
													@if($banner->row1_type == 3)
														<div class="blue-panel__more">
															{{ $banner->blue_row1 }}
															<svg>
																<use xlink:href="#arrow-link"></use>
															</svg>
														</div>
													@else
														<div>
															{{ $banner->blue_row1 }}
															<?php
															switch($banner->row1_type) {
																case 1: { echo '&nbsp;₽'; break; }
																case 2: { echo '&nbsp;₽/мес.'; break; }
																//case 3: { echo '&nbsp;>'; break; }
															};
															?>
														</div>
													@endif
												@endif

												@if(strlen($banner->blue_row2) > 0)
													@if($banner->row2_type == 3)
														<div class="blue-panel__more">
															{{ $banner->blue_row2 }}
															<svg>
																<use xlink:href="#arrow-link"></use>
															</svg>
														</div>
													@else
														<div>
															{{ $banner->blue_row2 }}
															<?php
															switch($banner->row2_type) {
																case 1: { echo '&nbsp;₽'; break; }
																case 2: { echo '&nbsp;₽/мес.'; break; }
																//case 3: { echo '&nbsp;>'; break; }
															};
															?>
														</div>
													@endif
												@endif

												@if(strlen($banner->blue_row3) > 0)
													@if($banner->row3_type == 3)
														<div class="blue-panel__more">
															{{ $banner->blue_row3 }}
															<svg>
																<use xlink:href="#arrow-link"></use>
															</svg>
														</div>
													@else
														<div>
															{{ $banner->blue_row3 }}
															<?php
															switch($banner->row3_type) {
																case 1: { echo '&nbsp;₽'; break; }
																case 2: { echo '&nbsp;₽/мес.'; break; }
																//case 3: { echo '&nbsp;>'; break; }
															};
															?>
														</div>
													@endif
												@endif

												{{--
												<div>
													от 1 999 000 ₽
												</div>
												<div>
													КАСКО в подарок
												</div>
												<div class="blue-panel__more">
													Подробнее
													<svg>
														<use xlink:href="#arrow-link"></use>
													</svg>
												</div>
												--}}
											</div>
										</div>
										@endif
									</a>
								</li>
							@endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="config">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="config" class="config__wrap">
						<div class="config__preloader" v-if="!init"></div>
                        <div class="config__body" :class="{animating: hcAnimating}" v-else>
                            <div class="config__layer">
                                <div class="config__holder">
                                    <div class="hc-bg" :style="{backgroundImage: 'url('+ hcData[hcCurrentIdx].bg + ')'}"></div>
                                    <div class="hc-bg hc-bg--next" :style="{backgroundImage: 'url('+ hcNextbg + ')'}"></div>
                                    <div class="config__header">
                                        <span class="hc-title">
                                            <span class="hc-title-clip">
                                                <strong class="hc-model">@{{hcData[hcCurrentIdx].name_ru}}</strong>
                                                <span class="hc-cost">@{{hcData[hcCurrentIdx].name_en}}</span>
                                                <span class="hc-cost">от @{{hcData[hcCurrentIdx].mincost | currencyFormat}} ₽</span>
                                            </span>
                                        </span>
                                        <a :href="hcData[hcCurrentIdx].urlcalc" class="df-credit-banner config__banner" v-show="hcData[hcCurrentIdx].credit_pay != 0">
                                            <div class="df-credit-banner__center config__banner-center">
                                                <div class="df-credit-banner__name config__credit-name">@{{hcData[hcCurrentIdx].credit_program}}</div>
                                                <div class="df-credit-banner__price config__credit-price">от @{{hcData[hcCurrentIdx].credit_pay | currencyFormat}}</div>
                                                <div class="df-credit-banner__credit config__credit-rub">руб / мес</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="hc-car">
                                        <img :src="hcData[hcCurrentIdx].picture" class="hc-car-img" :alt="hcData[hcCurrentIdx].name_ru"/>
                                    </div>
                                </div>
                                <div class="config__nav">
                                    <div class="config__nav-holder">
                                        <span class="config__nav-item config__nav-item--prev" @click="hcPrev">
                                            <strong class="config__item-title">@{{hcData[hcPrevIdx].name_ru}}</strong>
                                            <img :src="hcData[hcPrevIdx].picture" class="config__item-img" :alt="hcData[hcPrevIdx].name_ru"/>
                                            <span class="config__item-arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg"><use xlink:href="#left-link"></use></svg>
                                            </span>
                                        </span>
                                        <span class="config__nav-item config__nav-item--next" @click="hcNext">
                                            <strong class="config__item-title">@{{hcData[hcNextIdx].name_ru}}</strong>
                                            <img :src="hcData[hcNextIdx].picture" class="config__item-img" :alt="hcData[hcNextIdx].name_ru"/>
                                            <span class="config__item-arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg"><use xlink:href="#right-link"></use></svg>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <a :href="hcData[hcCurrentIdx].url" class="df-button config__button">Создать конфигурацию</a>
                                <div class="df-pagination-dots">
                                    <ul class="df-pagination-dots__list">
                                        <li class="df-pagination-dots__item" v-for="(data, index) in hcData">
                                            <button @click="goToPage(index)" v-bind:class="{ active: index === hcCurrentIdx }" class="df-pagination-dots__button"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="branches lazyload lazypreview" data-bgset="/images/index/branch.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <section data-bgset="/images/index/motorstudio.jpg" class="motorstudio-b lazyload lazypreview">
                        <a href="/motorstudio_moscow" class="motorstudio-b__logo">
                            <img src="/images/icons/motorstudio-logo.svg" alt="Motorstudio">
                        </a>
                        <div class="motorstudio-b__center">
                            <h2 class="motorstudio-b__title">Центр культурных событий и&nbsp;творческой атмосферы</h2>
                            <ul class="motorstudio-b__list">
                                <li class="motorstudio-b__item df-text-button-16px">
                                    Лекции
                                </li>
                                <li class="motorstudio-b__item df-text-button-16px">
                                    Выставки
                                </li>
                                <li class="motorstudio-b__item df-text-button-16px">
                                    Встречи
                                </li>
                            </ul>
                            <a href="https://www.hyundai.ru/motorstudio_moscow" class="motorstudio-b__button df-button">Календарь мероприятий</a>
                        </div>
                    </section>
                </div>
                <div class="col-lg-6 col-md-12">
                    <section class="mir-b lazyload lazypreview" data-bgset="/images/index/mir.jpg">
                        <div class="mir-b__top">
                            <a href="https://mir.hyundai.ru" class="mir-b__mir-link" role="button" aria-label="Мир Хёндэ">
                                <svg role="img" aria-hidden="true">
                                    <use xlink:href="#mir-logo"></use>
                                </svg>
                            </a>
                            <a href="https://mir.hyundai.ru" class="df-forward-link mir-b__reg" role="button" aria-label="Зарегистрироваться">
                                Зарегистрироваться
                                <svg  role="img" aria-hidden="true">
                                    <use xlink:href="#forward-link"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="mir-b__center">
                            <h2 class="mir-b__title">
								Платформа для владельцев автомобилей Hyundai и&nbsp;всех, кто хочет познакомиться с&nbsp;брендом.
                            </h2>
                            <ul class="mir-b__list">
                                <li class="mir-b__item">
                                    <div class="mir-b__icon ic-gift">
                                        <svg  role="img" aria-hidden="true">
                                            <use xlink:href="#mir-avatar"></use>
                                        </svg>
                                    </div>
                                    <div class="mir-b__description">
                                        Личный <br>кабинет
                                    </div>
                                    <div class="mir-b__text">
										Информация об автомобиле всегда под рукой
                                    </div>
                                </li>
                                <li class="mir-b__item">
                                    <div class="mir-b__icon ic-fix">
                                        <svg  role="img" aria-hidden="true">
                                            <use xlink:href="#mir-testdrive"></use>
                                        </svg>
                                    </div>
                                    <div class="mir-b__description">
										Запись <br>на тест-драйв
                                    </div>
                                    <div class="mir-b__text">
										Выберите дилерский центр и&nbsp;пройдите тест-драйв автомобиля
                                    </div>
                                </li>
                                <li class="mir-b__item">
                                    <div class="mir-b__icon ic-pig">
                                        <svg  role="img" aria-hidden="true">
                                            <use xlink:href="#mir-club"></use>
                                        </svg>
                                    </div>
                                    <div class="mir-b__description">
										Клуб <br>Hyundai
                                    </div>
                                    <div class="mir-b__text">
										Общайтесь и&nbsp;создавайте интересные маршруты
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mir-b__bottom">
                            <a class="mir-b__button df-button" href="https://mir.hyundai.ru" target="_blank">Войти</a>
                            <a href="https://mir.hyundai.ru" class="df-forward-link mir-b__reg-m" role="button" aria-label="Зарегистрироваться">
                                Зарегистрироваться
                                <svg  role="img" aria-hidden="true">
                                    <use xlink:href="#forward-link"></use>
                                </svg>
                            </a>
                            <ul class="mir-b__applications">
                                <li class="mir-b__app">
                                    <noindex>
                                        <a href="https://appsto.re/ru/X2Xxgb.i" target="_blank" rel="nofollow">
                                            <img src="/images/icons/appstore.svg" alt="App Store">
                                        </a>
                                    </noindex>
                                </li>
                                <li class="mir-b__app">
                                    <noindex>
                                        <a href="https://play.google.com/store/apps/details?id=com.mediapark.hyundai" target="_blank" rel="nofollow">
                                            <img src="/images/icons/googleplay.svg" alt="Google play">
                                        </a>
                                    </noindex>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section class="news" style="overflow: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="news__list owl-carousel js-news-slider">
                        @foreach($news_items as $news_item)
                        <li class="news__item">
                            <a href="/news/{{ $news_item->url }}" class="news__link" aria-label="{{ $news_item->title }}">
                                <div class="news__img">
                                    <img class="lazyload" data-src="{{ $news_item->getImgPathAttribute() }}" alt="{{ $news_item->title }}">
                                </div>
                                <div class="news__date df-text-input-14px">
                                    {{-- 18 января --}} {{ \App\Helpers\NumberHelper::formatDateMonth($news_item->date) }}
                                </div>
                                <div class="news__text df-lead-text-22px">
                                    {{ $news_item->title }}
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <a href="/news" class="df-forward-link news__all" role="button" aria-label="Все новости">
                        Все новости
                        <svg  role="img" aria-hidden="true">
                            <use xlink:href="#forward-link"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
	<script>
		var configJSON = <?=$configJSON;?>;
	</script>
	<script src="{{ mix('/js/lazypreview.js') }}"></script>
    <script src="{{ mix('/js/index/libs.js') }}"></script>
    <script src="{{ mix('/js/index/index.js') }}"></script>
@endsection
