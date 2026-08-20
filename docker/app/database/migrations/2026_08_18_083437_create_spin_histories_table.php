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
        Schema::create('spin_histories', function (Blueprint $table) {
            $table->id('history_id');
            $table->foreignId('respondent_id')
                ->constrained('survey_respondents', 'respondent_id')
                ->onDelete('cascade');
            $table->foreignId('reward_id')
                ->constrained('reward', 'reward_id')
                ->onDelete('cascade');
            $table->dateTime('spun_at');
            $table->integer('claimed_by');
            $table->string('guest_identifier', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spin_histories');
    }
};
