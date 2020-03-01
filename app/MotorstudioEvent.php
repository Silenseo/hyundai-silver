<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorstudioEvent extends Model
{
    protected $fillable = ['name', 'name_en', 'calendar_name', 'calendar_name_en', 'date_start', 'date_end', 'preview_picture', 'detail_picture', 'text', 'text_en', 'max_reg', 'is_promo', 'available', 'repair', 'visible'];

    protected $picPath = '/storage/motorstudio_events/';

    public function getPreviewPictureUrl() {
        return strlen($this->preview_picture) > 0 ? $this->picPath . $this->preview_picture : '';
    }

    public function getMobilePictureUrl() {
        return strlen($this->mobile_picture) > 0 ? $this->picPath . $this->mobile_picture : '';
    }

    public function getDetailPictureUrl() {
        return strlen($this->detail_picture) > 0 ? $this->picPath . $this->detail_picture : '';
    }
}
