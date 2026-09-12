<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WheelAssessment extends Model
{
    protected $table = 'wheel_assessments';
    protected $primaryKey = 'wheel_assessment_id';
    protected $fillable = ['wheel_id','assessment_id'];

    public function wheel()
    {
        return $this->belongTo(spin_wheels::class, 'wheel_id','wheel_id');
    }
}
