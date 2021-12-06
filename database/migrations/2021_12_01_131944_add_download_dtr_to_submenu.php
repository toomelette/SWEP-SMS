<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDownloadDtrToSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'NMVsmW2weJ1Ed2wC',
            'submenu_id' => 'mDDrHp',
            'menu_id' => 'GMPLGA',
            'is_nav' => 0,
            'name' => 'DTR Download',
            'nav_name' => '',
            'route' => 'dashboard.dtr.download',
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
        $sm = \App\Models\Submenu::query()->where('slug','=','NMVsmW2weJ1Ed2wC')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
