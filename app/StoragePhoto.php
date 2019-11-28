<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoragePhoto extends Model
{
    protected $fillable = ['file'];

    protected $picPath = '/storage/storage_photos/';

    public function getFileUrl()
    {
        return $this->picPath . $this->file;
    }
}
