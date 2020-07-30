<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = [
        'name', 'fileable_type', 'fileable_id'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
