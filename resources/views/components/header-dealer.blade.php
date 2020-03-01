<div class="dd-overlay"></div>
<div class="search-field">
    <div class="search-field-inner">
        <input type="text" class="search-input">
        <div class="search-close">
            <span class="df-close-button">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.00012207" y="14.5453" width="20.5702" height="2.05702" transform="rotate(-45 0.00012207 14.5453)" fill="#002C5F"></rect>
                    <rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)" fill="#002C5F"></rect>
                </svg>
            </span>
        </div>
    </div>
    <div class="search-body">
        <ul class="search-list"></ul>
        <div class="search-show-all">
            <a href="/search" class="search-all__link">Все результаты (<span class="search-counter">0</span>)</a>
        </div>
    </div>
</div>
<header class="header-main" role="navigation">
    <div class="header-top">
        <div class="support-service">
            <a class="support-service__link js-open-support-service__dropdown" href="#" role="button">
                <div class="support-service__text">{{ $dealerData['city' ]}}</div>
                <div class="support-service__phone">{{ $dealerData['phone'] }}</div>
                <svg role="img" aria-hidden="true" class="support-service__arrow">
                    <use xlink:href="#icon-Arrow_Dropdown"></use>
                </svg>
            </a>
            <div class="support-service__dropdown support-service__dropdown--dealer">
                <div class="s-contacts">
                    <div class="s-contacts__title">Контакты салонов</div>
                    <ul class="s-contacts__list">
                        <li class="s-contacts__item">
                            <a href="tel:{{ $dealerData['phone'] }}" class="s-contacts__phone">{{ $dealerData['phone'] }}</a>
                            <div class="s-contacts__address">{{ $dealerData['address'] }}</div>
                        </li>
                        <li class="s-contacts__item">
                            <a href="tel:88003337167" class="s-contacts__phone">8 800 333-71-67</a>
                            <div class="s-contacts__address">Cлужба клиентской поддержки</div>
                        </li>
                    </ul>
                </div>
                <hr>
                <a class="support-service__dd-mail" href="/ContactUs">
                    <svg role="img" aria-hidden="true">
                        <use xlink:href="#icon-mail_icon"></use>
                    </svg>
                    Обратная связь
                </a>
            </div>
        </div>
        <nav class="header-top__nav" role="navigation">
            <ul class="header-top__list">
<!--
                <li class="header-top__item">
                    <a href="#" class="header-top__link">
                        Контакты
                    </a>
                </li>
-->
                <li class="header-top__item">
                    <a href="/service-request" class="header-top__link">
                        Запись на сервис
                    </a>
                </li>
                <li class="header-top__item">
                    <a href="/test-drive" class="header-top__link">
                        Тест-драйв
                    </a>
                </li>
                <li class="header-top__item">
                    <a href="/start" target="_blank" class="header-top__link">
                        Кредит
                    </a>
                </li>
<!--
                <li class="header-top__item header-top__item--search js-search">
                    <a href="#" class="header-top__link">
                        <svg role="img" aria-hidden="true" class="icon-magnifier">
                            <use xlink:href="#icon-search"></use>
                        </svg>
                    </a>
                </li>
-->
            </ul>
        </nav>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 header-bottom__ps">
                    <div class="header-bottom__wrap">
                        <a href="/" aria-label="На главную" class="header-bottom__logo header-bottom__logo--dealer">
                            <svg role="img" aria-hidden="true">
                                <use xlink:href="#img-hyundai"></use>
                            </svg>
                            <div class="header-bottom__dealer-name">{{ $dealerData['name'] }}</div>
                        </a>

                        <div class="header-bottom__mobile-line">
                            <a href="/" aria-label="На главную" class="header-bottom__m-logo">
                                <svg role="img" aria-hidden="true">
                                    <use xlink:href="#img-hyundai"></use>
                                </svg>
                            </a>
                            <button class="hamburger hamburger--collapse js-open-mobile-menu" type="button" aria-label="Открыть мобильное меню">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                        <nav class="main-nav" role="navigation">
                            <ul class="main-nav__list">
                                <li class="main-nav__item">
                                    <a href="https://hyundai-berezniki.ru/" target="_blank" class="main-nav__link">
                                        Мы в Березниках
                                    </a>
                                </li>
                                <li class="main-nav__item">
                                    <a href="#" class="main-nav__link main-nav__link--contains-submenu js-main-submenu-open">
                                        Модельный ряд
                                        <svg role="img" aria-hidden="true" class="main-nav__arrow">
                                            <use xlink:href="#icon-Arrow_Dropdown"></use>
                                        </svg>
                                    </a>
                                    @component('components/dropdown-showroom')@endcomponent
                                </li>
                                <li class="main-nav__item">
                                    <a href="/configurator" class="main-nav__link">
                                        Конфигуратор
                                    </a>
                                </li>
                                <li class="main-nav__item">
                                    <a href="#" data-test="dd-service-open" class="main-nav__link main-nav__link--contains-submenu js-main-submenu-open">
                                        Сервис
                                        <svg role="img" aria-hidden="true" class="main-nav__arrow">
                                            <use xlink:href="#icon-Arrow_Dropdown"></use>
                                        </svg>
                                    </a>
                                    @component('components/dropdown-service')@endcomponent
                                </li>
                                <li class="main-nav__item">
                                    <a href="https://cars.hyundai-silver.ru/" target="_blank" class="main-nav__link">
                                        В наличии
                                    </a>
                                </li>
                                <li class="main-nav__item">
                                    <a href="https://hpromise.hyundai.ru/" target="_blank" class="main-nav__link">
                                        С пробегом
                                    </a>
                                </li>
                                <li class="main-nav__item">
                                    <a href="/all-offers" class="main-nav__link">
                                        Спецпредложения
                                    </a>
                                </li>
                                <li class="main-nav__item main-nav__item--mir">
                                    <a href="https://mir.hyundai.ru/" target="_blank" class="main-nav__link main-nav__link--iconed">
                                        Мир Хендэ
                                        <svg role="img" aria-hidden="true">
                                            <use xlink:href="#right-link"></use>
                                        </svg>
                                    </a>
                                </li>

                                <li class="main-nav__item main-nav__item--mobile">
                                    <a href="/service-request" class="main-nav__link">
                                        Запись на сервис
                                    </a>
                                </li>
                                <li class="main-nav__item main-nav__item--mobile">
                                    <a href="/test-drive" class="main-nav__link">
                                        Тест-драйв
                                    </a>
                                </li>
                                <li class="main-nav__item main-nav__item--mobile main-nav__item--support">
                                    <div class="support-service-m">
                                        <div class="support-service-m__text">Контакты</div>
                                        <a class="support-service-m__phone" href="tel:{{ $dealerData['phone'] }}">{{ $dealerData['phone'] }}</a>
                                        <hr>
                                        <div class="support-service-m__text">Служба клиентской поддержки</div>
                                        <a class="support-service-m__phone" href="tel:88003337167">8 800 333-71-67</a>
                                        <hr>
                                        <a class="support-service-m__mail" href="/ContactUs">
                                            <svg role="img" aria-hidden="true">
                                                <use xlink:href="#icon-mail_icon"></use>
                                            </svg>
                                            Обратная связь
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
