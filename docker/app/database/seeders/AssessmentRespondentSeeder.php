<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssessmentRespondent;

class AssessmentRespondentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Ronaldo Cr7','Leo Messi','Eden Hazard','Ishow Speed'];
        foreach ($names as $name) {
            AssessmentRespondent::create([
                'assessment_id' => 1,
                'full_name' => $name,
                'email' => null,
            ]);
        }
    }
}
