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
        $names = ['Ronaldo Cr6.5','Leo MessitheGoaT','Eden HazardTheGoaT2','Ishow SpeedNooob','Carlos Baleba','Mykhylo Mudryk','Roberto Carlos','Franchesko Totti'];
        foreach ($names as $name) {
            AssessmentRespondent::create([
                'assessment_id' => 3,
                'full_name' => $name,
                'email' => null,
            ]);
        }
    }
}
