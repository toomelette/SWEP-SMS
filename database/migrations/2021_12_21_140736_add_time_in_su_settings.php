<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeInSuSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\SuSettings::insert([
            [
                'setting' => 'jo_latest_time_in',
                'time_value' => '08:00:00',
            ],
            [
                'setting' => 'jo_earliest_time_out',
                'time_value' => '17:00:00',
            ],
            [
                'setting' => 'permanent_latest_time_in',
                'time_value' => '09:00:00',
            ],
            [
                'setting' => 'permanent_earliest_time_out',
                'time_value' => '16:00:00',
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
        $setting = \App\Models\SuSettings::query()->where('setting','=','jo_latest_time_in')->first();
        if(!empty($setting)){
            $setting->delete();
        }

        $setting = \App\Models\SuSettings::query()->where('setting','=','jo_earliest_time_out')->first();
        if(!empty($setting)){
            $setting->delete();
        }

        $setting = \App\Models\SuSettings::query()->where('setting','=','permanent_latest_time_in')->first();
        if(!empty($setting)){
            $setting->delete();
        }

        $setting = \App\Models\SuSettings::query()->where('setting','=','permanent_earliest_time_out')->first();
        if(!empty($setting)){
            $setting->delete();
        }
    }
}
