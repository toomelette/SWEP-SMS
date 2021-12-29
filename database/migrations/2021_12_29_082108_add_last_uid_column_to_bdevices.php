<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastUidColumnToBdevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('su_biometric_devices', function (Blueprint $table) {
            $table->integer('last_uid')->nullable(true);
            $table->string('remarks')->nullable(true);
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
            $table->dropColumn(['last_uid','remarks']);
        });
    }
}
