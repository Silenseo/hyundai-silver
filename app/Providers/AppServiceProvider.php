<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.master'], function($view) {
            $is_crawler = \Crawler::isCrawler();
            $view->with('is_crawler', $is_crawler);
        });

        view()->composer(['layouts.master-dealer', 'components/header-dealer', 'components/footer-dealer', 'frontend.service.index'], function($view) {
            $is_crawler = \Crawler::isCrawler();

            $dealerData = [
                'name' => 'Сильвер Моторс', //env('DEALER_NAME'),
                'email' => 'web@investmarketing.ru', //env('DEALER_EMAIL'),
                'city' => 'г. Пермь', //env('DEALER_CITY'),
                'phone' => '+7 (342) 225-08-76', //env('DEALER_PHONE'),
                'address' => 'г. Пермь, ул. Спешилова, 109', //env('DEALER_ADDRESS'),
                'sap' => 'C40AF01010',//env('DEALER_SAP'),
            ];

            $view->with('is_crawler', $is_crawler)->with('dealerData', $dealerData);
        });

        view()->composer(['components.dropdown-showroom', 'frontend.pages.sitemap'], function($view) {
            $cars_grouped = \Cache::remember('menu_cars_grouped', 0, function() {

                $cars = \App\Car::where('visible', 1)->where('is_old_model', 0)->orderBy('menu_row')->orderBy('menu_column')->get();
                $cars_grouped = [
                    '1' => [
                        'title' => 'Новинки',
                    ],
                    '2' => [
                        'title' => 'Городские',
                    ],
                    '3' => [
                        'title' => 'Кроссоверы',
                    ],
                    '4' => [
                        'title' => 'Микроавтобусы',
                    ],
                ];
                foreach($cars as $car) {
                    if($car->id == 11) continue;
                    $cars_grouped[$car->menu_row]['items'][] = $car;
                }

                return $cars_grouped;
            });

            unset($cars_grouped[1]);
            $view->with('menu_cars', $cars_grouped);
        });

        view()->composer(['components.dropdown-service', 'frontend.pages.sitemap'], function($view) {
            $menu_service = [
                'Сервисы' => [
                    'Калькулятор ТО' => '/service/maintenance#app',
                    'Акции сервис' => '/all-offers#service',
                ],
                'Обслуживание и ремонт' => [
                    'Обслуживание' => '/service/maintenance',
                    'Кузовной ремонт' => '/service/bodyworks',
                    'Гарантия' => '/service/warranty',
                    'Руководства и каталоги' => '/service/manuals',
                    'Электронная сервисная книжка' => '/service-book',
                    'Запись на сервис' => '/service-request',
                ],
                'Запасные части и аксессуары' => [
//                     'Бренд-коллекция' => '/brand-collection',
                    'Оригинальные запасные части' => '/service/parts',
                    'Оригинальные аксессуары' => 'https://acc.hyundai.ru/',
                    'Запчасти Product Line 2' => '/pl2',
                    'Моторное масло' => '/shell',
                ],
                'Сервисные предложения' => [
                    'Лучшее для своих' => '/service/best',
                    'Помощь на дороге' => '/service/assistance',
                    'На связи' => 'https://era.hyundai.ru/',
                ]
            ];
            $view->with('menu_service', $menu_service);
        });

        view()->composer('layouts.master', function($view) {
            $seo = [];


            $item = \App\SEO::where('url', '/' . \Request::path())->first();
            if($item) {
                $seo = $item->toArray();
            }
            $view->with('u_seo_info', $seo);
        });

        view()->composer('components.highlight-section', function($view) {
            $c = \App\Dealer::where('visible', 1)->count();
            $view->with('u_dealers_count', $c);
        });

        Blade::directive('u_userpermission', function ($expression) {
            return "<?php if(auth()->user()->hasAnyPermissionEx({$expression})): ?>";
        });

        Blade::directive('endu_userpermission', function ($expression) {
            return "<?php endif; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
