<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuDtr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Menu::insert([
            'slug' => 'OjM6liSKVeDpwZQc',
            'menu_id' => 'GMPLGA',
            'category' => 'HR',
            'name' => 'DTR',
            'route' => '',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::insert([
            'slug' => 'LrIKrK6SOddb70NO',
            'submenu_id' => 'rfOgNb0Y',
            'menu_id' => 'GMPLGA',
            'is_nav' => 1,
            'name' => 'DTR Extract',
            'nav_name' => 'Extract from Biometric',
            'route' => 'dashboard.dtr.extract',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::insert([
            'slug' => 'bpV5ETyj9hBbXc1c',
            'submenu_id' => 'DG7Oex',
            'menu_id' => 'GMPLGA',
            'is_nav' => 1,
            'name' => 'DTR Store',
            'nav_name' => '',
            'route' => 'dashboard.dtr.store',
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
        $menu = \App\Models\Menu::query()->where('slug','=','OjM6liSKVeDpwZQc')->first();
        if(!empty($menu)){
            $menu->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','LrIKrK6SOddb70NO')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','bpV5ETyj9hBbXc1c')->first();
        if(!empty($sm)){
            $sm->delete();
        }


    }
}
