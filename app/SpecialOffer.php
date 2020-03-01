<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Car;
use App\SpecialOfferLabel;

use App\Traits\SearchableTrait;

class SpecialOffer extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name', 'text'];

    protected $fillable = [];

    public function label()
    {
        return $this->belongsTo(SpecialOfferLabel::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'special_offer_car');
    }

    protected $picPath = '/storage/special_offers/';

    public function getPicPathAttribute() {
        return $this->picPath;
    }

    public function getImagePreviewUrl()
    {
        return strlen($this->image_preview) > 0 ? $this->picPath . $this->image_preview : '';
    }

    public function getImageWorldUrl()
    {
        return strlen($this->image_world) > 0 ? $this->picPath . $this->image_world : '';
    }

    // public function getImagePreviewAttribute()
    // {
    //     return $this->picPath . $this->attributes['image_preview'];
    // }

    // public function getImageWorldUrl()
    // {
    //     return $this->picPath . $this->image_world;
    // }

    public function getBannerUrl()
    {
        return strlen($this->banner) > 0 ? $this->picPath . $this->banner : '';
    }

    public function getBannerMobileUrl()
    {
        return strlen($this->banner_mobile) > 0 ? $this->picPath . $this->banner_mobile : $this->getBannerUrl();
    }

    public function getVideoDesktopUrl() {
        return strlen($this->video_desktop) ? $this->picPath . $this->video_desktop : '';
    }

    public function getVideoMobileUrl() {
        return strlen($this->video_mobile) ? $this->picPath . $this->video_mobile : '';
    }

    public function isVideo() {
        return !empty($this->video_desktop) && !empty($this->video_mobile) && file_exists(public_path() . $this->picPath . $this->video_desktop) && file_exists(public_path() . $this->picPath . $this->video_mobile);
    }
}
