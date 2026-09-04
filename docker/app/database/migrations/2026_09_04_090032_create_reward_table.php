<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('reward', function (Blueprint $reward) {
        $reward->id('reward_id');                 
        $reward->string('name', 200);             
        $reward->foreignId('category_id')->constrained('reward_categories', 'category_id');          
        $reward->unsignedInteger('created_by');           
        $reward->integer('quantity_reward');      
        $reward->integer('rate');                 
        $reward->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('reward');
    }
};