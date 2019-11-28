<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Car;

class AccessoriesProduct extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'article',
        'price',
        'image',
        'specs',
        'description',
        'order',
        'visible',
    ];

    protected $picPath = '/storage/accessories/products/';

    public function getImgPathAttribute()
    {
        return strlen($this->attributes['image']) > 0 ? $this->picPath . $this->attributes['image'] : '';
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class)->withPivot('price');
    }
}
