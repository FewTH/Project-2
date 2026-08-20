<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveyrespondent extends Model
{
 
    use HasFactory;
    protected $table = 'survey_respondents';
    protected $primaryKey = 'respondent_id';
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'responded_at',
        'survey_id',
    ];
}
