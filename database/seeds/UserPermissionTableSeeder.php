<?php

use Illuminate\Database\Seeder;

use App\UserPermission;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'seo_admin_main' => 'SEO',
            'news_admin_main' => 'Новости',
            'regions_admin_main' => 'Регионы',
            'dealers_admin_main' => 'Дилеры',
            'banners_admin_main' => 'Баннеры',
            'cars_admin_main' => 'Автомобили',
            'special_offers_admin_main' => 'Спецпредложения',
            'placeholders_admin_main' => 'Плейсхолдеры',
            'accessories_admin_main' => 'Аксессуары',
            'motorstudio_admin_main' => 'Моторстудио',
            'brandcollection_admin_main' => 'Бренд-коллекция',
            'manuals_admin_main' => 'Руководства и каталоги',
            'users_admin_main' => 'Пользователи',
            'user_roles_admin_main' => 'Группы пользователей',
            'siebel_logs_admin_main' => 'Siebel logs',
            'storage_photos_admin_main' => 'Фото',
            'dealer_menu_admin_main' => 'Дилерское меню',
        ];

        $up = UserPermission::whereIn('code', array_keys($items))->get()->pluck('code');

        foreach($items as $code => $name) {
            if($up->search($code) === false) {
                $model = new UserPermission();
                $model->name = $name;
                $model->code = $code;
                $model->save();
            }
        }
    }
}
