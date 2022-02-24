<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuAndSubmenusMisrequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Menu::query()->insert([
            'slug' => 'ptQX7MfbtJR2EtIf',
            'menu_id' => '2TCT5IM',
            'category' => 'MIS',
            'name' => 'Requests',
            'route' => 'dashboard.mis.*',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::query()->insert([
            [
                'slug' => '0sw0sIbs2o63SjIp',
                'submenu_id' => 'YPGD11A',
                'menu_id' => '2TCT5IM',
                'is_nav' => 1,
                'nav_name' =>'My Requests',
                'name' => 'Mis Request My Requests',
                'route' => 'dashboard.mis_requests.my_requests',
            ],
            [
                'slug' => 'PyXgmUqfXBPXwDdk',
                'submenu_id' => 'YYKDPDY',
                'menu_id' => '2TCT5IM',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Mis Request Store',
                'route' => 'dashboard.mis_requests.store',
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
        $sm = \App\Models\Menu::query()->where('slug','=','ptQX7MfbtJR2EtIf')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','0sw0sIbs2o63SjIp')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','PyXgmUqfXBPXwDdk')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
