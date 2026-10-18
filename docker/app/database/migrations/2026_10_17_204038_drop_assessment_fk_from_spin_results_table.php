<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spin_results', function (Blueprint $table){
            $table->dropForeign(['assessment_id']);
        });
    }

    public function down(): void
    {
        Schema::table('spin_results', function (Blueprint $table){
            $table->foreign('assessment_id')->references('assessment_id')->on('assessments');
        });
    }
};