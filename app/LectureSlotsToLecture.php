<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LectureSlotsToLecture extends Model
{
    protected $table = 'lecture_slots_to_lecture';

    protected $fillable = [
        'lecture_slot_id', 'lecture_id', 'sort_order',
    ];
}
