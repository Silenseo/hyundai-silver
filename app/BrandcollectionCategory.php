<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchableTrait;

class BrandcollectionCategory extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name'];

    protected $fillable = ['name', 'sort', 'is_active', 'code'];

    public function products() {
        return $this->hasMany('App\BrandcollectionProduct', 'category_id');
    }
}
