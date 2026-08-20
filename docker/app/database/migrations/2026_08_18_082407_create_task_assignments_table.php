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
        Schema::create('task_assignments', function (Blueprint $table) {
            $table->id('assignment_id');
            $table->foreignId('event_id') //ดึงข้อมูลในตาราบงอีเว้นมาไว้ในนี้
                ->constrained('event', 'event_id') //อันนี้คือบอกว่าดึงไอดีมาจากตารางอีเว้น
                ->onDelete('cascade'); //อันนี้คือเมื่อเราลบอะไรสักอันในตารางอีเว้นตารางอื่นที่เอาไอดีอีเว้นมาใช้ก็จะถูกลบตามไปด้วยแบบออโต้

            $table->foreignId('assigned_to')
                ->constrained('user', 'user_id') 
                ->onDelete('cascade');

            $table->foreignId('assigned_by')
                ->constrained('user', 'user_id')
                ->onDelete('cascade');
            
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->dateTime('assigned_at')->nullable();
            $table->datetime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_assignments');
    }
};
