<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessments';
    protected $primaryKey = 'assessment_id';
    protected $fillable = ['name','created_by_name','closed_at','is_open'];
    
    // วงล้อที่ผูกกับแบบประเมิน
    public function WheelAssessment()
    {
        return $this->hasOne(WheelAssessment::class, 'assessment_id','assessment_id');
    }
}
