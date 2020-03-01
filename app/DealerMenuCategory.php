<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchableTrait;

class DealerMenuCategory extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name', 'sort', 'active'];

    public function pages() {
        return $this->hasMany('App\DealerMenuPage');
    }
}
