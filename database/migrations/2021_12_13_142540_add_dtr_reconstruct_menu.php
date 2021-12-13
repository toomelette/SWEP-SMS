<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDtrReconstructMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'VFR9Z9HtWv9nit1K',
            'submenu_id' => '0QTPTUK',
            'menu_id' => 'GMPLGA',
            'is_nav' => 0,
            'route' => 'dashboard.dtr.reconstruct',
            'nav_name' => '',
            'name' => 'Recontruct DTR',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sm = \App\Models\Submenu::query()->where('slug','=','VFR9Z9HtWv9nit1K')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
