<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spin_wheels', function (Blueprint $wheel) {
            $wheel->id('wheel_id');
            $wheel->string('name', 200);
            $wheel->tinyInteger('is_active')->default(1);
            $wheel->foreignId('created_by')
                ->constrained('users', 'user_id')
                ->onDelete('cascade');
            $wheel->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spin_wheels');
    }
};