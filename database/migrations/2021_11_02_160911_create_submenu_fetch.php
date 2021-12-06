<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmenuFetch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'FmtIxXzAHqE8Hmj0',
            'submenu_id' => 'SM10000963',
            'menu_id' => 'M10011',
            'is_nav' => 0,
            'name' => 'Submenu Fetch',
            'route' => 'dashboard.submenu.fetch',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Submenu::where('slug','FmtIxXzAHqE8Hmj0')->delete();
    }
}
