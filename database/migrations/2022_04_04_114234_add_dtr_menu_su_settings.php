<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDtrMenuSuSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\SuSettings::query()->insert([
            'setting' => 'dtr_menu',
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
        $sm = \App\Models\SuSettings::query()->where('setting','=','dtr_menu')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
