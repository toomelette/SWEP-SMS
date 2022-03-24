<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingForSqlServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\SuSettings::insert([
            'setting' => 'sql_server',
            'int_value' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sm = \App\Models\SuSettings::query()->where('setting','=','sql_server')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
