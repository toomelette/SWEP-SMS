<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenusToFile201 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up(){
        $name = 'File 201';
        $route = 'file201';
        \App\Models\Menu::query()->insert([
            'slug' => 'OLSrbGVMT6gZYmWt',
            'menu_id' => 'EYURLYX',
            'category' => 'HR',
            'name' => 'File 201',
            'route' => 'dashboard.file201.*',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::query()->insert([
            [
                'slug' => 'bhMuDi72ukQ5gfY3',
                'submenu_id' => 'ZJMEJWF',
                'menu_id' => 'EYURLYX',
                'is_nav' => 0,
                'nav_name' =>'Manage',
                'name' => 'File 201 Index',
                'route' => 'dashboard.file201.index',
            ],
            [
                'slug' => 'xysBDKYhJ9JFUr3j',
                'submenu_id' => 'HLRM1HZ',
                'menu_id' => 'EYURLYX',
                'is_nav' => 0,
                'nav_name' =>'Manage',
                'name' => 'File 201 Create',
                'route' => 'dashboard.file201.create',
            ],
            [
                'slug' => 'PyalRjEedTxFXQQz',
                'submenu_id' => 'UE9WV3W',
                'menu_id' => 'EYURLYX',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'File 201 Store',
                'route' => 'dashboard.file201.store',
            ],
            [
                'slug' => 'BmFCILe3zg67FGI8',
                'submenu_id' => 'RKCOYGJ',
                'menu_id' => 'EYURLYX',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'File 201 Edit',
                'route' => 'dashboard.file201.edit',
            ],
            [
                'slug' => 'XiuQahzNwByjEv7L',
                'submenu_id' => 'IWA2MDX',
                'menu_id' => 'EYURLYX',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'File 201 Update',
                'route' => 'dashboard.file201.update',
            ],
            [
                'slug' => 'EXnmVOxiLCATPE1R',
                'submenu_id' => 'YEL6PFU',
                'menu_id' => 'EYURLYX',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'File 201 Show',
                'route' => 'dashboard.file201.show',
            ],
            [
                'slug' => 'SAmuvraZac81SScy',
                'submenu_id' => 'POXXHDN',
                'menu_id' => 'EYURLYX',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'File 201 Destroy',
                'route' => 'dashboard.file201.destroy',
            ]
        ]);
    }

    public function down()
        {
            $sm = \App\Models\Menu::query()->where('slug','=','OLSrbGVMT6gZYmWt')->first();
            if(!empty($sm)){
                $sm->delete();
            }

            $sm = \App\Models\Submenu::query()->where('slug','=','bhMuDi72ukQ5gfY3')->first();
            if(!empty($sm)){
                $sm->delete();
            }

            $sm = \App\Models\Submenu::query()->where('slug','=','xysBDKYhJ9JFUr3j')->first();
            if(!empty($sm)){
                $sm->delete();
            }

            $sm = \App\Models\Submenu::query()->where('slug','=','PyalRjEedTxFXQQz')->first();
            if(!empty($sm)){
                $sm->delete();
            }

            $sm = \App\Models\Submenu::query()->where('slug','=','BmFCILe3zg67FGI8')->first();
            if(!empty($sm)){
                $sm->delete();
            }

            $sm = \App\Models\Submenu::query()->where('slug','=','XiuQahzNwByjEv7L')->first();
            if(!empty($sm)){
                $sm->delete();
            }

            $sm = \App\Models\Submenu::query()->where('slug','=','EXnmVOxiLCATPE1R')->first();
            if(!empty($sm)){
                $sm->delete();
            }

            $sm = \App\Models\Submenu::query()->where('slug','=','SAmuvraZac81SScy')->first();
            if(!empty($sm)){
                $sm->delete();
            }
        }


}
