<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentRespondent extends Model
{
    protected $table = 'assessment_respondents';
    protected $primaryKey = 'respondent_id';
    protected $fillable = ['full_name','assessment_id','email','is_drawn','drawn_at'];
}
