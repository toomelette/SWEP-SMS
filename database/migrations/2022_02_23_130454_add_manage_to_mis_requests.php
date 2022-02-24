<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManageToMisRequests extends Migration
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
                'slug' => 'JPKOHABDf9qw23p2',
                'submenu_id' => 'IMVPFRC',
                'menu_id' => '2TCT5IM',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Mis Request Index',
                'route' => 'dashboard.mis_requests.index',
            ],
            [
                'slug' => 'VHcEGXnp8lHY9pJw',
                'submenu_id' => 'NJPRID7',
                'menu_id' => '2TCT5IM',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Mis Request Show',
                'route' => 'dashboard.mis_requests.show',
            ],
            [
                'slug' => 'NCOJVhlI4HxF2PRD',
                'submenu_id' => 'I4MB9XV',
                'menu_id' => '2TCT5IM',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Mis Request Update',
                'route' => 'dashboard.mis_requests.update',
            ],
            [
                'slug' => 'fSHdGQG0sl1gm1Td',
                'submenu_id' => 'NJPRID7',
                'menu_id' => '2TCT5IM',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Mis Request Status',
                'route' => 'dashboard.mis_requests_status.index',
            ],
            [
                'slug' => 'Gcy9BicpyTaueuL8',
                'submenu_id' => 'ASTHYVP',
                'menu_id' => '2TCT5IM',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Mis Request Status Update (Store)',
                'route' => 'dashboard.mis_requests_status.store',
            ],
            [
                'slug' => '8c3U1FcHNPBwUXgs',
                'submenu_id' => 'IN0KVSM',
                'menu_id' => '2TCT5IM',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Mis Request Status Delete',
                'route' => 'dashboard.mis_requests_status.destroy',
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
        $sm = \App\Models\Submenu::query()->where('slug','=','JPKOHABDf9qw23p2')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','VHcEGXnp8lHY9pJw')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','fSHdGQG0sl1gm1Td')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','Gcy9BicpyTaueuL8')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','8c3U1FcHNPBwUXgs')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','NCOJVhlI4HxF2PRD')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
