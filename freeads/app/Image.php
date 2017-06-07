<?php

namespace freeads;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'annonce_id',
        'filePath',
        'image'
    ];
}
