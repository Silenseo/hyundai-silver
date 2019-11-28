<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandcollectionTag extends Model
{
    protected $fillable = ['name', 'sort', 'is_active'];
}
