<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaveApiKeyToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\SuSettings::insert([
            'setting' => 'google_calendar_api_key',
            'string_value' => 'AIzaSyB_uQnZb2VMNTHc2c5vwqzR7Jxjhhr2f0Q',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sm = \App\Models\SuSettings::query()->where('setting','=','google_calendar_api_key')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
