<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CsvFile extends Model
{
	protected $fillable = ['id', 'name', 'code', 'file'];

	protected $filePath = '/storage/csvfiles/';

	public function getFileUrl()
	{
		return strlen($this->file) > 0 ? $this->filePath . $this->file : '';
	}
}
