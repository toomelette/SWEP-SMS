<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEditMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::query()->insert([
            [
                'slug' => 'M89T6thl8rDF3dOi',
                'submenu_id' => 'H7VX1GE',
                'menu_id' => '2TCT5IM',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Mis Request Edit',
                'route' => 'dashboard.mis_requests.edit',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sm = \App\Models\Submenu::query()->where('slug','=','M89T6thl8rDF3dOi')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
