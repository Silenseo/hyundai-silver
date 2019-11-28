<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminFormProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Form::component('adminInput', 'components.admin.input', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('adminTextarea', 'components.admin.textarea', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('adminFile', 'components.admin.file', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('adminCheckbox', 'components.admin.checkbox', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('adminRadiobutton', 'components.admin.radio', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('adminDropdown', 'components.admin.dropdown', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('adminTextarea', 'components.admin.textarea', ['name', 'value' => null, 'attributes' => []]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
