<?php

use Illuminate\Database\Seeder;

use App\UserRole;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin' => 'Администраторы',
            'seo' => 'СЕО',
            'motorstudio' => 'Motorstudio',
            'accessories' => 'Аксессуары',
            'brandcollection' => 'Бренд-Коллекция'
        ];

        $ur = UserRole::whereIn('code', array_keys($roles))->get()->pluck('code');

        foreach($roles as $role_code => $role_name) {
            if($ur->search($role_code) === false) {
                $userrole = new UserRole();
                $userrole->name = $role_name;
                $userrole->code = $role_code;
                $userrole->save();
            }
        }
    }
}
