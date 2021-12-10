<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuForHoliday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Menu::insert([
            'slug' => 'VEMl4Db2GZ1YNfeu',
            'menu_id' => 'MKWhON',
            'category' => 'HR',
            'name' => 'Holidays',
            'route' => '',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //index
        \App\Models\Submenu::insert([
            'slug' => 'UkAfkgjyPVrfWXmJ',
            'submenu_id' => '3QVI8KP',
            'menu_id' => 'MKWhON',
            'is_nav' => 1,
            'name' => 'Holidays Index',
            'nav_name' => 'Manage',
            'route' => 'dashboard.holidays.index',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //store
        \App\Models\Submenu::insert([
            'slug' => 'qmCw1yImwC9jj7nr',
            'submenu_id' => 'TMRWYR0',
            'menu_id' => 'MKWhON',
            'is_nav' => 0,
            'name' => 'Holidays Store',
            'nav_name' => '',
            'route' => 'dashboard.holidays.store',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //edit
        \App\Models\Submenu::insert([
            'slug' => 'e0FTr6cMrkubnanX',
            'submenu_id' => 'NNHQEKF',
            'menu_id' => 'MKWhON',
            'is_nav' => 0,
            'name' => 'Holidays Edit',
            'nav_name' => '',
            'route' => 'dashboard.holidays.edit',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //update
        \App\Models\Submenu::insert([
            'slug' => 'irCQb0AoFJHxO30F',
            'submenu_id' => '9IOKXAA',
            'menu_id' => 'MKWhON',
            'is_nav' => 0,
            'name' => 'Holidays Update',
            'nav_name' => '',
            'route' => 'dashboard.holidays.update',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //show
        \App\Models\Submenu::insert([
            'slug' => 'DcwxWlYBheB0cPks',
            'submenu_id' => 'IKCUZQI',
            'menu_id' => 'MKWhON',
            'is_nav' => 0,
            'name' => 'Holidays Show',
            'nav_name' => '',
            'route' => 'dashboard.holidays.show',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //destroy
        \App\Models\Submenu::insert([
            'slug' => 'rZggfiTUaJtKTr8G',
            'submenu_id' => 'BXFOJRH',
            'menu_id' => 'MKWhON',
            'is_nav' => 0,
            'name' => 'Holidays Show',
            'nav_name' => '',
            'route' => 'dashboard.holidays.destroy',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //destroy
        \App\Models\Submenu::insert([
            'slug' => 'OAWLc1u0FybCNzmW',
            'submenu_id' => 'MAGOAIU',
            'menu_id' => 'MKWhON',
            'is_nav' => 0,
            'name' => 'Holidays Destroy',
            'nav_name' => '',
            'route' => 'dashboard.holidays.destroy',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        //fetch_google
        \App\Models\Submenu::insert([
            'slug' => 'HKOg2IFwh0VIFOlR',
            'submenu_id' => 'VFJ5TFM',
            'menu_id' => 'MKWhON',
            'is_nav' => 0,
            'name' => 'Holidays Fetch Google Calendar',
            'nav_name' => '',
            'route' => 'dashboard.holidays.fetch_google',
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
        $menu = \App\Models\Menu::query()->where('slug','=','VEMl4Db2GZ1YNfeu')->first();
        if(!empty($menu)){
            $menu->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','UkAfkgjyPVrfWXmJ')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','qmCw1yImwC9jj7nr')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','e0FTr6cMrkubnanX')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','irCQb0AoFJHxO30F')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','DcwxWlYBheB0cPks')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','rZggfiTUaJtKTr8G')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','OAWLc1u0FybCNzmW')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','HKOg2IFwh0VIFOlR')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
