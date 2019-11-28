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
                                    <li class="showroom__car showroom__car" style="display: block;">
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

                                <li class="showroom__car showroom__car">
                                    <a href="/NewSonata" class="d-car" aria-label="NEWSONATA">
                                        <div class="d-car__top-line">
                                            <h5 class="d-car__title">Новая СОНАТА</h5>
                                            <div class="d-car__name">/ SONATA</div>
                                        </div>
                                        <div class="d-car__price">от 1 725 000 ₽</div>
                                        <div class="d-car__m-name">SONATA</div>
                                        <div class="d-car__img">
                                            <img class="showroom-lazyload" data-showroomsrc="/storage/cars/1574242069.png" alt="Новая SONATA" src="/storage/cars/1574242069.png">
                                        </div>
                                    </a>
                                </li>
                                <li class="showroom__car showroom__car"></li>
                            </ul>
                        </li>                        
                        
                        
                        <?php 
                          $f = false; 
                          
                          echo "<!--  333333333";
                          print_r($menu_cars);
                          echo "-->";
                          
                        ?>
                        
                        
                        @foreach($menu_cars as $menu_car)
                            @if(isset($menu_car['items']) && isset($menu_car['title']))
                            <li class="showroom__line">
                                <h4 class="showroom__title">{{ $menu_car['title'] }}</h4> 
                                <ul class="showroom__cars">
                                    @if($f)
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
                        {{-- <li class="showroom__line">
                            <h4 class="showroom__title">Коммерческие</h4>
                            <ul class="showroom__cars">
                                <li class="showroom__car showroom__car">
                                    <a href="https://hyundaitrucks.ru/trucks/gruzoviki/" class="d-car" target="_blank">
                                        <div class="d-car__top-line">
                                            <h5 class="d-car__title">Грузовики</h5>
                                            <div class="d-car__name"></div>
                                        </div>
                                        <div class="d-car__price"></div>
                                        <div class="d-car__m-name"></div>
                                        <div class="d-car__img">
                                            <img class="showroom-lazyload" data-showroomsrc="/images/cars/hd35.png" alt="HD35">
                                        </div>
                                        <span class="showroom__cat-item-name" style="color: #103a71;"><br>Выбрать модель&nbsp;<svg role="img" aria-hidden="true" style="width: 24px; height: 10px;"><use xlink:href="#right-link"></use></svg></span>
                                    </a>
                                </li>
                                <li class="showroom__car showroom__car">
                                    <a href="https://hyundaitrucks.ru/trucks/avtobusy/" class="d-car" target="_blank">
                                        <div class="d-car__top-line">
                                            <h5 class="d-car__title">Автобусы</h5>
                                            <div class="d-car__name"></div>
                                        </div>
                                        <div class="d-car__price"></div>
                                        <div class="d-car__m-name"></div>
                                        <div class="d-car__img">
                                            <img class="showroom-lazyload" data-showroomsrc="/images/cars/bus.png" alt="bus">
                                        </div>
                                        <span class="showroom__cat-item-name" style="color: #103a71;"><br>Выбрать модель&nbsp;<svg role="img" aria-hidden="true" style="width: 24px; height: 10px;"><use xlink:href="#right-link"></use></svg></span>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
