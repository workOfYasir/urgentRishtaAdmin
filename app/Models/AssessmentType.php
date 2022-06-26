<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentType extends Model
{
    public function lastAssessment(){
        return $this->hasOne(Assessment::class,'type_id')->orderBy('date','desc');
    }
}
