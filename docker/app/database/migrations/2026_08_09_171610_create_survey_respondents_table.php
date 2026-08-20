<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('survey_respondents', function (Blueprint $survey_respondent) {
            $survey_respondent->id('respondent_id');
            $survey_respondent->unsignedInteger('user_id');
            $survey_respondent->string('full_name', 200)->nullable();
            $survey_respondent->string('email', 200)->nullable();
            $survey_respondent->dateTime('responded_at')->useCurrent();
            $survey_respondent->unsignedInteger('survey_id');
            $survey_respondent->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('survey_respondents');
    }
};
