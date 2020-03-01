<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    protected $table = 's_e_os';
    protected $fillable = [
        'url',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'og_title',
        'og_image',
        'og_description'
    ];
    //
}
