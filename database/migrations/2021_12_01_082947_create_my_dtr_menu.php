<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyDtrMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'AKaLvG9408CN7P4l',
            'submenu_id' => 'BLOMZI',
            'menu_id' => 'GMPLGA',
            'is_nav' => 1,
            'name' => 'My DTR',
            'nav_name' => 'My DTR',
            'route' => 'dashboard.dtr.my_dtr',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sm = \App\Models\Submenu::query()->where('slug','=','AKaLvG9408CN7P4l')->first();

        if(!empty($sm)){
            $sm->delete();
        }
    }
}
