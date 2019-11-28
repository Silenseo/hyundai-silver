<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchableTrait;

class BrandcollectionProduct extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name', 'description'];

    protected $picPath = '/storage/brandcollection_products/';

    public function category() {
        return $this->belongsTo('App\BrandcollectionCategory', 'category_id');
    }

    public function tag() {
        return $this->belongsTo('App\BrandcollectionTag', 'tag_id');
    }

    public function getImageUrl()
    {
        return strlen($this->image) > 0 ? $this->picPath . $this->image : '';
    }
}
