<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiometricDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('su_biometric_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('serial_no');
            $table->string('ip_address');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('su_biometric_devices')->insert([
            [
                'name' => 'Treasury Office',
                'ip_address' => '10.36.1.20',
                'serial_no' => '0348143100222',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('su_biometric_devices');
    }
}
