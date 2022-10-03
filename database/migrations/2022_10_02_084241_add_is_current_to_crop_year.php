<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCurrentToCropYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_crop_year', function (Blueprint $table) {
            $table->integer('is_current')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_crop_year', function (Blueprint $table) {
            $table->dropColumn('is_current');
        });
    }
}
