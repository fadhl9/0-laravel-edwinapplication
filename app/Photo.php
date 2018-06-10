<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = ['file', 'id'];

    protected $uploads = '/images/';

    //Accessor
    public function getFileAttribute($photo) {
        return $this->uploads . $photo;
    }

}
