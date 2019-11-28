<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchableTrait;

class News extends Model
{
    use SearchableTrait;

    protected $searchableFields = ['title', 'text'];

    protected $fillable = [
        'date',
        'title',
        'url',
        'text',
        'img',
        'comment',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'visible'
    ];

    protected $picPath = '/storage/news/';
    protected $Months = Array(1=>'января',2=>'февраля',3=>'марта',4=>'апреля',5=>'мая',6=>'июня',7=>'июля',8=>'августа',9=>'сентября',10=>'октября',11=>'ноября',12=>'декабря');

    public function getImgPathAttribute()
    {
        return strlen($this->attributes['img']) > 0 ? $this->picPath . $this->attributes['img'] : '';
    }

    public function getDateAdminFormatAttribute()
    {
        return date('Y-m-d', $this->attributes['date']);
    }

    public function getDatePublicAttribute()
    {
        $date = date('d.m.Y', $this->attributes['date']);
        $date = explode('.', $date);

        return $date[0] . ' ' . $this->Months[(int)$date[1]] . ' ' . $date[2];
    }
}
