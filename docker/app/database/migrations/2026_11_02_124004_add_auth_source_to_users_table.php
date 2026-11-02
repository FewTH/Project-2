<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password_hash', 255)->nullable()->change();
            $table->string('email', 200)->nullable()->change();
            $table->string('auth_source', 10)->default('local')->after('role'); // local | api
        });

        // ผู้ใช้เดิมที่ไม่มีรหัสผ่าน ถือเป็นผู้ใช้จาก API
        DB::table('users')
            ->where(fn ($q) => $q->whereNull('password_hash')->orWhere('password_hash', ''))
            ->update(['auth_source' => 'api']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('auth_source');
        });
    }
};