<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('events', function (Blueprint $event) {
            $event->id('event_id');
            $event->unsignedInteger('wheel_id');
            $event->string('title', 300);
            $event->dateTime('register_close_at')->nullable();
            $event->unsignedInteger('max_participants')->nullable();
            $event->json('register_fields')->nullable();
            $event->string('qr_code_url', 500)->nullable();
            $event->enum('status', ['draft', 'open', 'closed', 'completed'])->default('draft');
            $event->unsignedInteger('created_by');
            $event->dateTime('created_at')->useCurrent();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
