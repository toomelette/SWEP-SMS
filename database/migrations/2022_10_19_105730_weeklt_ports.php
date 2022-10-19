<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WeekltPorts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            $table->string('user_canceled')->nullable()->after('submitted_at');
            $table->dateTime('canceled_at')->nullable()->after('submitted_at');
            $table->string('user_submitted')->nullable()->after('submitted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            $table->dropColumn('user_canceled', 'canceled_at', 'user_submitted');
        });
    }
}
