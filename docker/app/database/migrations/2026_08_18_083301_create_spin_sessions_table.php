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
        Schema::create('spin_sessions', function (Blueprint $table) {
            $table->id('session_id');
            $table->foreignId('wheel_id')
                ->constrained('spin_wheels', 'wheel_id')
                ->onDelete('cascade');
            $table->enum('source_type');
            $table->integer('source_id');
            $table->dateTime('spun_at');
            $table->foreignId('spun_by')
                ->constrained('user', 'user_id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spin_sessions');
    }
};
