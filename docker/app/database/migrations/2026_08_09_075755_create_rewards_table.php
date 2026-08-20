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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id('reward_id');    //primarykey ของ ตารางreward
            $table->string('name');     //ชื่อของรางวัล ตารางreward
            $table->integer('quantity');    //จำนวนรางวัล ของ ตารางreward
            $table->foreignId('category_id')    //ใช้ของตาราง reward_categories
                  ->constrained('reward_categories', 'category_id')
                  ->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
