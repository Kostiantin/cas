<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $fillable = [
        'name', 'sub-title', 'description', 'user_id',
    ];

    public function sequences()
    {
        return $this->hasMany(Sequence::class);
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
