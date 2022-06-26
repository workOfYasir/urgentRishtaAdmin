<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignWorkout extends Model
{
    protected $fillable=[ 
            'plan_id',
            'week_id',
            'client_id',
            'start_date',
            'id_delete',
        ];
}
