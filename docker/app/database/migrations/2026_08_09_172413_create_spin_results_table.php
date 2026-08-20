<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('spin_results', function (Blueprint $spin_result) {
            $spin_result->id('result_id');
            $spin_result->unsignedInteger('gift_id');
            $spin_result->string('qr_code', 500);
            $spin_result->string('winner_name', 255);
            $spin_result->enum('receive_status', ['pending', 'received', 'expired'])->default('pending');
            $spin_result->dateTime('receive_deadline')->nullable();
            $spin_result->string('receive_location', 300)->nullable();
            $spin_result->dateTime('received_at')->nullable();
            $spin_result->dateTime('created_at')->useCurrent();
            $spin_result->unsignedInteger('session_id');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('spin_results');
    }
};
