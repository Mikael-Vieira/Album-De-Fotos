<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['name', 'description', 'cover_photo'];

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'album_photo');
    }
}


