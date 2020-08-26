<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseToModule extends Model
{
    protected $table = 'course_to_module';

    protected $fillable = [
        'course_id', 'module_id', 'sort_order',
    ];
}
