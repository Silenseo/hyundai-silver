<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchableTrait;

class StaticSearch extends Model
{
	use SearchableTrait;

	protected $table = 'static_search';
	protected $fillable = ['url', 'img', 'text'];

	protected $searchableFields = ['text'];
}
