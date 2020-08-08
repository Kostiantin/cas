<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $fillable = [
        'name', 'sub-title', 'description',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
