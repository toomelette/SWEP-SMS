<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuAndSubmenuForJoEmployees extends Migration
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
                'slug' => 'xdznWiofQDjaQ0CT',
                'submenu_id' => 'CPuYdpN',
                'menu_id' => 'M10013',
                'is_nav' => 1,
                'name' => 'JO Employees Index',
                'nav_name' => 'Job Order',
                'route' => 'dashboard.jo_employees.index',
            ],
            [
                'slug' => 'NFHBzS2Gww9CYQVE',
                'submenu_id' => 'xUH1D6',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'name' => 'JO Employees Store',
                'nav_name' => '',
                'route' => 'dashboard.jo_employees.store',
            ],
            [
                'slug' => 'TaN4UGtFCz8L5cxA',
                'submenu_id' => 'tFMVGA',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'name' => 'JO Employees Edit',
                'nav_name' => '',
                'route' => 'dashboard.jo_employees.edit',
            ],
            [
                'slug' => '1Q7pmTsAWkAqs3hr',
                'submenu_id' => 'wwQNCn',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'name' => 'JO Employees Update',
                'nav_name' => '',
                'route' => 'dashboard.jo_employees.update',
            ],
            [
                'slug' => '24HU3cXb7YnfjUUX',
                'submenu_id' => 'CqOSNZ5',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'name' => 'JO Employees Show',
                'nav_name' => '',
                'route' => 'dashboard.jo_employees.show',
            ],
            [
                'slug' => 'nuJFSRzIrFH2SASj',
                'submenu_id' => 'WKFVoH',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'name' => 'JO Employees Delete',
                'nav_name' => '',
                'route' => 'dashboard.jo_employees.destroy',
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
        $sm = \App\Models\Submenu::query()->where('slug','=','xdznWiofQDjaQ0CT')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','NFHBzS2Gww9CYQVE')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','TaN4UGtFCz8L5cxA')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','1Q7pmTsAWkAqs3hr')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','24HU3cXb7YnfjUUX')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','nuJFSRzIrFH2SASj')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
