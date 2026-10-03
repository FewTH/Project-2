<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spin_results', function (Blueprint $table) {
            $table->enum('email_status', ['pending', 'sent', 'failed'])
                  ->default('pending')
                  ->after('checked_by_user_id');

            $table->dateTime('email_sent_at')->nullable()->after('email_status');
        });
    }

    public function down(): void
    {
        Schema::table('spin_results', function (Blueprint $table) {
            $table->dropColumn(['email_status', 'email_sent_at']);
        });
    }
};