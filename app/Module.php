<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{


    protected $fillable = [
        'name', 'code', 'description'
    ];

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
