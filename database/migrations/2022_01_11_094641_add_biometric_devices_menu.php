<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBiometricDevicesMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('su_menus')->insert([
            'slug' => 'b1mZd2EtK5DyWxAp',
            'menu_id' => 'RZPOQUS',
            'category' => 'SU',
            'name' => 'Biometric Devices',
            'route' => 'dashboard.biometric_devices.*',
            'icon' => 'fa-clock-o',
            'is_menu' => 1,
            'is_dropdown' => 1,
        ]);

        \App\Models\Submenu::insert([
            [
                'slug' => 'Iy2i1rYfn4TqANMb',
                'submenu_id' => 'RRQ40DN',
                'menu_id' => 'RZPOQUS',
                'is_nav' => 1,
                'route' => 'dashboard.biometric_devices.index',
                'name' => 'Biometric Devices Index',
                'nav_name' => 'Manage',
            ],
            [
                'slug' => 'm5uta7hZgwkNGcPC',
                'submenu_id' => '8IO8EEL',
                'menu_id' => 'RZPOQUS',
                'is_nav' => 0,
                'route' => 'dashboard.biometric_devices.restart',
                'name' => 'Biometric Device Restart',
                'nav_name' => '',
            ],
            [
                'slug' => 'GnnUpYzByq1GtbkS',
                'submenu_id' => 'BNKC2ZD',
                'menu_id' => 'RZPOQUS',
                'is_nav' => 0,
                'route' => 'dashboard.biometric_devices.attendances',
                'name' => 'Biometric Device Attendances',
                'nav_name' => '',
            ],
            [
                'slug' => 'yVLRLRRq2rB3Tce2',
                'submenu_id' => 'L2HNQGT',
                'menu_id' => 'RZPOQUS',
                'is_nav' => 0,
                'route' => 'dashboard.biometric_devices.extract',
                'name' => 'Biometric Device Extract',
                'nav_name' => '',
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
        $m = \App\Models\Menu::query()->where('slug','=','b1mZd2EtK5DyWxAp')->first();
        if(!empty($m)){
            $m->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','Iy2i1rYfn4TqANMb')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','m5uta7hZgwkNGcPC')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','GnnUpYzByq1GtbkS')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','yVLRLRRq2rB3Tce2')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
    }
}
