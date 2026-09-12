<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $eventregistrations) {
            $eventregistrations->id('registration_id');
            $eventregistrations->unsignedBigInteger('event_id');
            $eventregistrations->unsignedBigInteger('user_id')->nullable();
            $eventregistrations->string('full_name', 200);
            $eventregistrations->timestamp('registered_at')->useCurrent();
            $eventregistrations->boolean('is_drawn')->default(false);
            $eventregistrations->timestamp('drawn_at')->nullable();
            $eventregistrations->unsignedBigInteger('reward_id')->nullable();

            $eventregistrations->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $eventregistrations->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
            $eventregistrations->foreign('reward_id')->references('reward_id')->on('reward')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};