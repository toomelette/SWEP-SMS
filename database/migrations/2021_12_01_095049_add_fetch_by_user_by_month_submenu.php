<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFetchByUserByMonthSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'D1P3NbnIQ4CkGPvL',
            'submenu_id' => 'ShWtH',
            'menu_id' => 'GMPLGA',
            'is_nav' => 0,
            'name' => 'DTR Fetch By User and Month',
            'nav_name' => '',
            'route' => 'dashboard.dtr.fetch_by_user_and_month',
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
        $sm = \App\Models\Submenu::query()->where('slug','=','D1P3NbnIQ4CkGPvL')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
