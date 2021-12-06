<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmenuIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'Q3BuJUlRKxOdRGVe',
            'submenu_id' => 'SM10000962',
            'menu_id' => 'M10011',
            'is_nav' => 0,
            'name' => 'Submenu Index',
            'route' => 'dashboard.submenu.index',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Submenu::where('slug','Q3BuJUlRKxOdRGVe')->delete();
    }
}
