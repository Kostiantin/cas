<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LectureSlot extends Model
{
    protected $fillable = [
        'day_id', 'sort_order',
    ];
}
