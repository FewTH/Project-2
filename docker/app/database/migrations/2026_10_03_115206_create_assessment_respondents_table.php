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
        Schema::create('assessment_respondents', function (Blueprint $table) {
            $table->id('respondent_id');
            $table->unsignedInteger('assessment_id'); //รอapiของพี่
            $table->string('full_name',150);
            $table->string('email', 255)->nullable();
            $table->tinyInteger('is_drawn')->default(0);
            $table->dateTime('drawn_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_respondents');
    }
};
