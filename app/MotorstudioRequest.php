<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorstudioRequest extends Model
{
    public function event() {
        return $this->belongsTo('App\MotorstudioEvent');
    }
}
