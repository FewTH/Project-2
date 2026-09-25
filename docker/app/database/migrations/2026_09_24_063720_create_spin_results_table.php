<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('spin_results', function (Blueprint $spinresults) {
            $spinresults->id('result_id');

            // FK ไปหาตาราง reward มีอยู่จริง
            $spinresults->foreignId('reward_id')->constrained('reward', 'reward_id');
            // FK ไปหาตาราง assessments มีอยู่จริงแ
            $spinresults->foreignId('assessment_id')->constrained('assessments', 'assessment_id');
            $spinresults->string('qr_code', 500)->unique();
            $spinresults->string('winner_name', 255);
            $spinresults->enum('receive_status', ['received', 'not-received'])->default('not-received');
            $spinresults->dateTime('receive_deadline')->nullable();
            $spinresults->dateTime('received_at')->nullable();
            $spinresults->foreignId('checked_by_user_id')->nullable()->constrained('users', 'user_id');
            $spinresults->timestamps();
            
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('spin_results');
    }
};
