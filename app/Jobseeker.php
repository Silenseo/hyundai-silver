<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobseeker extends Model
{
	protected $fillable = [];

	// protected $filePath = '/storage/jobseeker/';

	// public function getFileUrl()
	// {
	// 	return strlen($this->file) > 0 ? $this->filePath . $this->file : '';
	// }
}
