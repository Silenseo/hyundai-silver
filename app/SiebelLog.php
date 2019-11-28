<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiebelLog extends Model
{
    protected $fillable = ['source', 'type', 'logId', 'data'];
}
