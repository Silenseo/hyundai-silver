<div data-test="dd-service" class="main-nav__dropdown main-nav__dropdown--grey">
    <div class="container df-dropdown">
        <ul class="row">
            <a href="#" class="main-nav__dropdown-close js-main-submenu-close" aria-label="Закрыть меню">
                <svg role="img" aria-hidden="true">
                    <use xlink:href="#close_icon"></use>
                </svg>
            </a>
            @foreach($menu_service as $service_name => $service_cat)
                <li class="df-dropdown__item col-lg-3 col-md-12">
                    <h4 class="df-dropdown__title js-dropdown-submenu-open">
                        {{ $service_name }}
                        <svg role="img" aria-hidden="true">
                            <use xlink:href="#menu-arrow"></use>
                        </svg>
                    </h4>
                    <ul class="df-dropdown__submenu">
                        @foreach($service_cat as $title => $link)
                        <li class="df-dropdown__submenu-item">
                            <a href="{{ $link }}" class="df-dropdown__link" {!! strpos($link, 'http') === 0 ? 'target="_blank"' : '' !!}><span>{{ $title }}</span></a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
