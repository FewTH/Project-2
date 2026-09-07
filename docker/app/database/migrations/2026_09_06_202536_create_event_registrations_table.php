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
            $eventregistrations->string('email', 200)->nullable();
            $eventregistrations->timestamp('registered_at')->useCurrent();

            $eventregistrations->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $eventregistrations->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
