<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //เก็บว่าใครเป็นคนกดสุ่ม (user_id ของ admin/manager)
        Schema::table('spin_results', function (Blueprint $table) {
            $table->unsignedBigInteger('drawn_by')->nullable()->after('assessment_id');
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('drawn_by')->nullable()->after('reward_id');
        });

        Schema::table('event_reward_draws', function (Blueprint $table) {
            $table->unsignedBigInteger('drawn_by')->nullable()->after('reward_id');
        });
    }

    public function down(): void
    {
        Schema::table('spin_results', function (Blueprint $table) {
            $table->dropColumn('drawn_by');
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn('drawn_by');
        });

        Schema::table('event_reward_draws', function (Blueprint $table) {
            $table->dropColumn('drawn_by');
        });
    }
};