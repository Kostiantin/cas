<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $fillable = [
        'title', 'sub_title', 'description',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
