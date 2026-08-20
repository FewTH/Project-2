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
        Schema::create('spin_wheels', function (Blueprint $table) {
            $table->id('wheel_id');
            $table->string('name', 200);
            $table->tinyint('is_active');
            $table->foreignId('created_by')
                ->constrained('user', 'user_id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spin_wheels');
    }
};
