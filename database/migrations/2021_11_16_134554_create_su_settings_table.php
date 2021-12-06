<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('su_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('setting');
            $table->integer('int_value')->nullable()->default(null);
            $table->string('string_value')->nullable()->default(null);
            $table->date('date_value')->nullable()->default(null);
            $table->time('time_value')->nullable()->default(null);
        });

        \Illuminate\Support\Facades\DB::table('su_settings')->insert([
            'setting' => 'afternoon_prayer',
            'time_value' => '15:00:00',
//            'int_value' => 0,
//            'string_value' => '',
//            'date_value' => null,
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('su_settings');
    }
}
