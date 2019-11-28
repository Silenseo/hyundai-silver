<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\CitiesRegion;

class Dealer extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'email', 'code', 'rc_code', 'site', 'latitude', 'longitude', 'visible', 'zyngaya', 'city_id', 'special', 'wa', 'hidden', 'rating', 'prohibition_requests'];

    public function city() {
        return $this->belongsTo(CitiesRegion::class);
    }
}
