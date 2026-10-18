<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id')->unique(); // id จาก API ไม่ต้องใส่ FK
            $table->unsignedBigInteger('assigned_to');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_assignments');
    }
};
