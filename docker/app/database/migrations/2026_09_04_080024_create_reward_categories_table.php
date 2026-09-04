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
        Schema::create('reward_categories', function (Blueprint $category) {
            $category->id('category_id'); //primarykeyของตารางนี้
            $category->string('name',100); //ชื่อหมวดหมู่
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_categories');
    }
};
