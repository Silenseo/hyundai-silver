<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchableTrait;

class DealerMenuPage extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name', 'url', 'sort', 'active', 'category.name'];

    public function category() {
        return $this->belongsTo('App\DealerMenuCategory');
    }
}
