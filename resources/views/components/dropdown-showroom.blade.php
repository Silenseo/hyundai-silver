<div class="main-nav__dropdown main-nav__dropdown--showroom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="showroom">
                    <a href="#" class="main-nav__dropdown-close js-main-submenu-close" aria-label="Закрыть меню">
                        <svg role="img" aria-hidden="true">
                            <use xlink:href="#close_icon"></use>
                        </svg>
                    </a>
                    <ul class="showroom__list">
                        <li class="showroom__line">
                            <h4 class="showroom__title">Новинки</h4> 
            
                            <ul class="showroom__cars">
                            
                                <li class="showroom__car showroom__car">
                                    <a href="/promo/solaris_super_series_2" class="d-car">
                                        <div class="d-car__top-line">
                                            <h5 class="d-car__title">СУПЕР СЕРИЯ II</h5>
                                            <div class="d-car__name">/ SOLARIS</div>
                                        </div>
                                        <div class="d-car__price">от {{ number_format(857000, 0, '.', ' ') }} ₽</div>
                                        <div class="d-car__m-name">СУПЕР СЕРИЯ II</div>
                                        <div class="d-car__img">
                                            <img class="showroom-lazyload" data-showroomsrc="/assets/ss/ss2_pic.png" alt="СУПЕР СЕРИЯ">
                                        </div>
                                    </a>
                                </li>                              

                                <li class="showroom__car showroom__car first-place">
                                    <a href="/promo/creta-rock" class="d-car">
                                        <div class="d-car__top-line">
                                            <h5 class="d-car__title">ROCK EDITION</h5>
                                            <div class="d-car__name">/ CRETA</div>
                                        </div>
                                        <div class="d-car__price">от {{ number_format(1405000, 0, '.', ' ') }} ₽</div>
                                        <div class="d-car__m-name">ROCK EDITION</div>
                                        <div class="d-car__img">
                                            <img class="showroom-lazyload" data-showroomsrc="/assets/ss/new/creta_rock.png" alt="ROCK EDITION">
                                        </div>
                                    </a>
                                </li> 
                                
                                <li class="showroom__car showroom__car">
                                    <a href="/NewSonata" class="d-car">
                                        <div class="d-car__top-line">
                                            <h5 class="d-car__title">Новая СОНАТА</h5>
                                            <div class="d-car__name">/ SONATA</div>
                                        </div>
                                        <div class="d-car__price">от {{ number_format(1740000, 0, '.', ' ') }} ₽</div>
                                        <div class="d-car__m-name">SONATA</div>
                                        <div class="d-car__img">
                                            <img class="showroom-lazyload" data-showroomsrc="/storage/cars/1574242069.png" alt="Новая SONATA">
                                        </div>
                                    </a>
                                </li>
                                
                                <li class="showroom__car showroom__car">

                                </li>
                            </ul>
                        </li>                     
                    
                        <?php
                          $f = true;
                          $k = 0;
                        ?>
                        
                        @foreach($menu_cars as $menu_car)
                            @if(isset($menu_car['items']))
                            <?php $k++; ?>
                            <li class="showroom__line">
                                <h4 class="showroom__title">{{ $menu_car['title'] }}</h4>
                                <ul class="showroom__cars">
                                    @if($f)
                                        <!--li class="showroom__car showroom__car">
                                            <a href="/promo/solaris_super_series_2" class="d-car">
                                                <div class="d-car__top-line">
                                                    <h5 class="d-car__title">СУПЕР СЕРИЯ II</h5>
                                                    <div class="d-car__name">/ SOLARIS</div>
                                                </div>
                                                <div class="d-car__price">от {{ number_format(857000, 0, '.', ' ') }} ₽</div>
                                                <div class="d-car__m-name">СУПЕР СЕРИЯ II</div>
                                                <div class="d-car__img">
                                                    <img class="showroom-lazyload" data-showroomsrc="/assets/ss/ss2_pic.png" alt="СУПЕР СЕРИЯ">
                                                </div>
                                            </a>
                                        </li>

                                        <li class="showroom__car showroom__car first-place">
                                            <a href="/promo/creta-rock" class="d-car">
                                                <div class="d-car__top-line">
                                                    <h5 class="d-car__title">ROCK EDITION</h5>
                                                    <div class="d-car__name">/ CRETA</div>
                                                </div>
                                                <div class="d-car__price">от {{ number_format(1405000, 0, '.', ' ') }} ₽</div>
                                                <div class="d-car__m-name">ROCK EDITION</div>
                                                <div class="d-car__img">
                                                    <img class="showroom-lazyload" data-showroomsrc="/assets/ss/new/creta_rock.png" alt="ROCK EDITION">
                                                </div>
                                            </a>
                                        </li-->
                                    @endif
                                    
                                    @if($k == 1)
                                        <li class="showroom__car showroom__car">
                                            <a href="/promo/solaris_super_series" class="d-car">
                                                <div class="d-car__top-line">
                                                    <h5 class="d-car__title">СУПЕР СЕРИЯ</h5>
                                                    <div class="d-car__name">/ SOLARIS</div>
                                                </div>
                                                <div class="d-car__price">от {{ number_format(880000, 0, '.', ' ') }} ₽</div>
                                                <div class="d-car__m-name">СУПЕР СЕРИЯ</div>
                                                <div class="d-car__img">
                                                    <img class="showroom-lazyload" data-showroomsrc="/assets/ss/ss_pic.png" alt="СУПЕР СЕРИЯ">
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                    
                                    @foreach($menu_car['items'] as $car)
                                    <li class="showroom__car showroom__car<?=$car->id == 3 || $car->id == 6 ? ' first-place' : '';?>">
                                        <a href="/{{ $car->id_text }}" class="d-car" aria-label="{{ strtoupper($car->id_text) }}">
                                            <div class="d-car__top-line">
                                                <h5 class="d-car__title">{{ $car->name_menu_rus }}</h5>
                                                <div class="d-car__name">/ {{ $car->name_menu_en }}</div>
                                            </div>
                                            <div class="d-car__price">от {{ number_format($car->price_min, 0, '.', ' ') }} ₽</div>
                                            <div class="d-car__m-name">{{ $car->name_menu_en }}</div>
                                            <div class="d-car__img">
                                                <img class="showroom-lazyload" data-showroomsrc="{{ $car->getImageUrl() }}" alt="{{ $car->name }}">
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </li>
                            <?php $f = false; ?>
                            @endif
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
