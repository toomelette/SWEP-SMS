<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemarksToHrDailyTimeRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_daily_time_records', function (Blueprint $table) {
            $table->string('remarks')->nullable();
            $table->timestamp('remarks_updated_at')->nullable();
            $table->string('remarks_user_updated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_daily_time_records', function (Blueprint $table) {
            $table->dropColumn('remarks','remarks_updated_at','remarks_user_updated');

        });
    }
}
