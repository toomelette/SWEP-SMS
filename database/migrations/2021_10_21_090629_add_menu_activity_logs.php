<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AddMenuActivityLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('su_menus')->insert([
            'slug' => Str::random(12),
            'menu_id' => 'M10023',
            'category' => '',
            'name' => 'Activity Logs',
            'route' => 'dashboard.activity_logs.*',
            'icon' => 'fa-clock-o',
            'is_menu' => 0,
            'is_dropdown' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Menu::where('menu_id','M10023')->delete();
    }
}
