<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wheel_assessments', function(Blueprint $table){
            $table->id('wheel_assessment_id');
            $table->foreignId('wheel_id')
                ->constrained('spin_wheels', 'wheel_id')
                ->onDelete('cascade');
            $table->unsignedInteger('assessment_id');
            $table->unique('assessment_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wheel_assessments');
    }
};
