<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Car;

use App\Traits\SearchableTrait;

class WarrantyCar extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['name', 'description', 'car.name'];

    protected $fillable = [];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
 
