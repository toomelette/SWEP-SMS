<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubmenuActivityLogsFetchProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => \Illuminate\Support\Str::random(12),
            'submenu_id' => 'SM10000961',
            'menu_id' => 'M10023',
            'is_nav' => 0,
            'route' => 'dashboard.activity_logs_fetch_properties',
            'name' => 'Activity Logs Fetch Properties',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Submenu::where('submenu_id','SM10000961')->delete();
    }
}
