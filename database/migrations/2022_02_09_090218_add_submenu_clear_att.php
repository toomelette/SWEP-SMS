<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubmenuClearAtt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'IMXaWFopk0HbVh86',
            'submenu_id' => 'HG5MHQB',
            'menu_id' => 'RZPOQUS',
            'is_nav' => 0,
            'route' => 'dashboard.biometric_devices.clear_attendance',
            'name' => 'Biometric Device Clear Attendance',
            'nav_name' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sm = \App\Models\Submenu::query()->where('slug','=','IMXaWFopk0HbVh86')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
