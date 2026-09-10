<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function list()
    {
        $mockAssess=[
            ['id'=>1,'name'=>'แบบประเมิน1'],
            ['id'=>2,'name'=>'แบบประเมิน2'],
            ['id'=>3,'name'=>'แบบประเมิน3'],
        ];
        return response()->json($mockAssess);
    }
}
