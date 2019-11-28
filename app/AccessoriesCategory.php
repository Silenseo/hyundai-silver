<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessoriesCategory extends Model
{
    protected $fillable = [
        'name',
        'subtitle',
        'image',
        'order',
        'visible'
    ];

    protected $picPath = '/storage/accessories/categories/';

    public function getImgPathAttribute()
    {
        return strlen($this->attributes['image']) > 0 ? $this->picPath . $this->attributes['image'] : '';
    }
}
