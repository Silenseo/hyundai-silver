<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Car;

use App\Traits\SearchableTrait;

class Manual extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name', 'car.name'];

    protected $filePath = '/storage/manual/';

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function getFileUrl()
    {
        if(strlen($this->link) > 0)
            return $this->link;
        else
            return strlen($this->file) > 0 ? $this->filePath . $this->file : '';
    }
}
