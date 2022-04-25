<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenusSuNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        $name = 'News';
        $route = 'news';
        \App\Models\Menu::query()->insert([
            'slug' => '9um0SpcFvpJghHhM',
            'menu_id' => 'ECWQKXK',
            'category' => 'SU',
            'name' => 'News',
            'route' => 'dashboard.news.*',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::query()->insert([
            [
                'slug' => 'csXDzsIdFqiTdBin',
                'submenu_id' => '7JPJ53S',
                'menu_id' => 'ECWQKXK',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Bulletin Index',
                'route' => 'dashboard.news.index',
            ],
            [
                'slug' => 'S17uvjEki8jisjaS',
                'submenu_id' => '6DDFAFX',
                'menu_id' => 'ECWQKXK',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Bulletin Store',
                'route' => 'dashboard.news.store',
            ],
            [
                'slug' => '0WaEPWruqMcwyL2T',
                'submenu_id' => '5JIM3MQ',
                'menu_id' => 'ECWQKXK',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Bulletin Edit',
                'route' => 'dashboard.news.edit',
            ],
            [
                'slug' => '5TXcAmpNvGK8DsJ1',
                'submenu_id' => 'XH47AQO',
                'menu_id' => 'ECWQKXK',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Bulletin Update',
                'route' => 'dashboard.news.update',
            ],
            [
                'slug' => 'EeEgZ4ox7UG2vL32',
                'submenu_id' => 'MKYURR0',
                'menu_id' => 'ECWQKXK',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Bulletin Show',
                'route' => 'dashboard.news.show',
            ],
            [
                'slug' => '7LIZ6JAaKAEPE8qZ',
                'submenu_id' => 'L1PBR2Y',
                'menu_id' => 'ECWQKXK',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Bulletin Destroy',
                'route' => 'dashboard.news.destroy',
            ]
        ]);
    }

    public function down()
    {
        $sm = \App\Models\Menu::query()->where('slug','=','9um0SpcFvpJghHhM')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','csXDzsIdFqiTdBin')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','S17uvjEki8jisjaS')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','0WaEPWruqMcwyL2T')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','5TXcAmpNvGK8DsJ1')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','EeEgZ4ox7UG2vL32')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','7LIZ6JAaKAEPE8qZ')->first();
        if(!empty($sm)){
            $sm->delete();
        }


    }
}
