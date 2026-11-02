<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // ลิงก์แบบประเมินที่จะให้ผู้ใช้สแกนหลังสุ่มรางวัลเสร็จ
            $table->string('assessment_url', 2000)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('assessment_url');
        });
    }
};
