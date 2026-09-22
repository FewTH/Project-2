<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assessment; 

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['name'=>'แบบประเมิน1','created_by_name'=>'Adminbuulib','closed_at'=>'2026-09-19'],
            ['name'=>'แบบประเมิน2','created_by_name'=>'Adminbuulib','closed_at'=>'2026-09-17'],
            ['name'=>'แบบประเมิน3','created_by_name'=>'Adminbuulib','closed_at'=>'2026-09-10'],
        ];
        foreach($data as $item){
            Assessment::create($item);
        }
    }
}
