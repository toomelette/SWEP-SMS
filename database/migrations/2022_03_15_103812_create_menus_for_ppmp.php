<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusForPpmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Menu::query()->insert([
            'slug' => 'ZuyppnFXuVLd8SQl',
            'menu_id' => '5PGUP0A',
            'category' => 'PPU',
            'name' => 'PPMP',
            'route' => 'dashboard.ppmp.*',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::query()->insert([
            [
                'slug' => 'mKIPouZLomVnJjda',
                'submenu_id' => 'WJZUXTT',
                'menu_id' => '5PGUP0A',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'PPMP Index',
                'route' => 'dashboard.ppmp.index',
            ],
            [
                'slug' => 'yXd65nwBd04RHuLA',
                'submenu_id' => 'MCD6ZDR',
                'menu_id' => '5PGUP0A',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'PPMP Store',
                'route' => 'dashboard.ppmp.store',
            ],
            [
                'slug' => 'cB95O5tPDcC6xcZH',
                'submenu_id' => 'X8LPJS6',
                'menu_id' => '5PGUP0A',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'PPMP Edit',
                'route' => 'dashboard.ppmp.edit',
            ],
            [
                'slug' => 't5FL65VG5qoU6THz',
                'submenu_id' => 'WKNWC58',
                'menu_id' => '5PGUP0A',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'PPMP Update',
                'route' => 'dashboard.ppmp.update',
            ],
            [
                'slug' => 'eVCZKcUTL3rfeZwJ',
                'submenu_id' => 'KFTGMTL',
                'menu_id' => '5PGUP0A',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'PPMP Show',
                'route' => 'dashboard.ppmp.show',
            ],
            [
                'slug' => 'JwQPdRjLDiYSMVAM',
                'submenu_id' => 'EWHKRVB',
                'menu_id' => '5PGUP0A',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'PPMP Destroy',
                'route' => 'dashboard.ppmp.destroy',
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
        $sm = \App\Models\Menu::query()->where('slug','=','ZuyppnFXuVLd8SQl')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','mKIPouZLomVnJjda')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','yXd65nwBd04RHuLA')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','cB95O5tPDcC6xcZH')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','t5FL65VG5qoU6THz')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','eVCZKcUTL3rfeZwJ')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','JwQPdRjLDiYSMVAM')->first();
        if(!empty($sm)){
            $sm->delete();
        }


    }
}
