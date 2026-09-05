<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wheel_items', function (Blueprint $wheelitem) {
            $wheelitem->id('item_id');
            $wheelitem->foreignId('wheel_id')
                ->constrained('spin_wheels', 'wheel_id')
                ->onDelete('cascade');
            $wheelitem->foreignId('reward_id')
                ->constrained('reward', 'reward_id')
                ->onDelete('cascade');
            $wheelitem->integer('quantity_selected')->default(1); // จำนวนที่ใส่เข้าวงล้อ
            $wheelitem->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wheel_items');
    }
};