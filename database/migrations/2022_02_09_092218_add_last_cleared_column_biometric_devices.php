<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastClearedColumnBiometricDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('su_biometric_devices', function (Blueprint $table) {
            $table->dateTime('last_cleared')->nullable(true);
            $table->string('last_cleared_user')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('su_biometric_devices', function (Blueprint $table) {
            $table->dropColumn(['last_cleared','last_cleared_user']);
        });
    }
}
