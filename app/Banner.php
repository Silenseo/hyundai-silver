<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['id', 'name', 'title', 'subtitle', 'image', 'image_mobile', 'image_text', 'blue_show', 'blue_row1', 'blue_row2', 'blue_row3', 'font_color', 'row1_type', 'row2_type', 'row3_type', 'order', 'visible'];

    protected $picPath = '/storage/banners/';
    //

    public function getImageUrl()
    {
        return $this->picPath . $this->image;
    }

    public function getImageMobileUrl()
    {
        return $this->picPath . $this->image_mobile;
    }
}
