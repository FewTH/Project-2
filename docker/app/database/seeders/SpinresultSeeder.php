<?php

namespace Database\Seeders;

use App\Models\Spinresult;
use Illuminate\Database\Seeder;

class SpinresultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // สร้างข้อมูลปลอม 30 แถว
        Spinresult::factory()->count(30)->create();
    }
}