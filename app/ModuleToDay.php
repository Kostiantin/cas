<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleToDay extends Model
{
    protected $table = 'module_to_day';

    protected $fillable = [
        'day_id', 'module_id', 'sort_order',
    ];
}
