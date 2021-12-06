<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmenuStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'Amc4xmLMwbxgog3x',
            'submenu_id' => 'SM10000964',
            'menu_id' => 'M10011',
            'is_nav' => 0,
            'name' => 'Submenu Store',
            'route' => 'dashboard.submenu.store',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Submenu::where('slug','Amc4xmLMwbxgog3x')->delete();
    }
}
