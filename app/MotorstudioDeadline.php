<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorstudioDeadline extends Model
{
    protected $fillable = ['closed_from', 'closed_to', 'show_from', 'show_to', 'reason'];
}
