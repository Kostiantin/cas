<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    
    protected $fillable = [
        'certificate_id',
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }
}
