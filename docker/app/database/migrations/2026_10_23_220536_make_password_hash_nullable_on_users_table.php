<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password_hash', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        // ย้อนกลับได้เมื่อไม่มีแถวที่ password_hash เป็น null
        Schema::table('users', function (Blueprint $table) {
            $table->string('password_hash', 255)->nullable(false)->change();
        });
    }
};