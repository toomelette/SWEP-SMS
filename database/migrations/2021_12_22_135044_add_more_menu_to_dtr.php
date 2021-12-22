<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreMenuToDtr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            [
                'slug' => 'X6U1AwLARtpldpWw',
                'submenu_id' => 'VODFKKM',
                'menu_id' => 'GMPLGA',
                'is_nav' => 1,
                'name' => 'DTR Index',
                'nav_name' => 'Manage',
                'route' => 'dashboard.dtr.index',
            ],
            [
                'slug' => '7YS3atIL0xcmvXRj',
                'submenu_id' => 'G9DXEYV',
                'menu_id' => 'GMPLGA',
                'is_nav' => 0,
                'name' => 'DTR Show',
                'nav_name' => '',
                'route' => 'dashboard.dtr.show',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sm = \App\Models\Submenu::query()->where('slug','=','X6U1AwLARtpldpWw')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','7YS3atIL0xcmvXRj')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
