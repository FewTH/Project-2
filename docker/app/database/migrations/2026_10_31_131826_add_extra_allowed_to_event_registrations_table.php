<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // รหัสเครื่องของคนที่ไม่ล็อกอิน (เก็บในคุกกี้ด้วย)
            $table->string('guest_token', 64)->nullable()->index()->after('user_id');

            // จำนวนครั้งที่คนนี้ยังลงทะเบียนเพิ่มได้ (แอดมินให้ ลดเมื่อใช้)
            $table->unsignedInteger('extra_allowed')->default(0);

            // จำนวนครั้งที่แอดมินเคยให้สิทธิ์สะสมทั้งหมด (ไม่ลดตอนใช้)
            $table->unsignedInteger('extra_granted')->default(0);
        });

        // คนไม่ล็อกอินไม่มี user_id จึงต้องเป็น null ได้
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropIndex(['guest_token']);
            $table->dropColumn(['guest_token', 'extra_allowed', 'extra_granted']);
        });
    }
};