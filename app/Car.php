<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\WarrantyCar;

use App\Traits\SearchableTrait;

class Car extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name'];

    protected $fillable = [
        'name',
        'name_menu_rus',
        'name_menu_en',
        'id_text',
        'price_min',
        'siebel_code',
        'menu_row',
        'menu_column',
        'conf_id',
        'image',
        'img_left_mp',
        'img_right_mp',
        'img_beauty_mp',
        'visible',
        'is_promo',
        'ga_modelcode',
        'conf_car_id',
        'is_old_model',
        'tradein'
    ];
    protected $picPath = '/storage/cars/';
    protected $urlPrefix = '';
    //

    public function getUrlAttribute() {
        return $this->urlPrefix . '/' . $this->id_text;
    }

    public function getImageUrl()
    {
        return strlen($this->image) > 0 ? $this->picPath . $this->image : '';
    }

    public function getImageLeftUrl()
    {
        return strlen($this->img_left_mp) > 0 ? $this->picPath . $this->img_left_mp : '';
    }

    public function getImageRightUrl()
    {
        return strlen($this->img_right_mp) > 0 ? $this->picPath . $this->img_right_mp : '';
    }

    public function getImageBeautyUrl()
    {
        return strlen($this->img_beauty_mp) > 0 ? $this->picPath . $this->img_beauty_mp : '';
    }

    public function warranties() {
        return $this->hasMany(WarrantyCar::class);
    }
    public function manuals()
    {
        return $this->hasMany('App\Manual');
    }
}
