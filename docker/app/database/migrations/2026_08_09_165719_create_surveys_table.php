<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $survey) {
            $survey->id('survey_id');
            $survey->unsignedInteger('wheel_id');
            $survey->string('title', 300);
            $survey->string('external_id', 200)->nullable();
            $survey->enum('status', ['open', 'closed', 'completed'])->default('open');
            $survey->dateTime('closed_at')->nullable();
            $survey->dateTime('received_at')->nullable();
            $survey->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
