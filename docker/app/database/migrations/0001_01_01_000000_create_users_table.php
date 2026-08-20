<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $user) {
            $user->id('user_id');
            $user->string('username', 100)->unique();
            $user->string('full_name', 200);
            $user->string('email', 200);
            $user->string('password_hash', 255);
            $user->enum('role', ['admin', 'wheel_manager', 'user'])->default('user');
            $user->tinyInteger('is_active')->default(1);
            $user->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};