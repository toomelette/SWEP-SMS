<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Menu::insert([
            'slug' => '95wrqbW2j0IOScVV',
            'menu_id' => 'UJRCYH',
            'category' => 'PPU',
            'name' => 'PAP',
            'route' => '',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::insert([
            'slug' => 'taC50cGUfcKAhwKG',
            'submenu_id' => 'bheEfH0hQx',
            'menu_id' => 'UJRCYH',
            'is_nav' => 1,
            'name' => 'PAP Index',
            'nav_name' => 'Manage',
            'route' => 'dashboard.pap.index',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::insert([
            'slug' => 'HbBi0D539h6BOUqT',
            'submenu_id' => '1txMvRYu',
            'menu_id' => 'UJRCYH',
            'is_nav' => 1,
            'name' => 'PAP Parents Index',
            'nav_name' => 'PAP Parents',
            'route' => 'dashboard.pap_parent.index',
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
        \App\Models\Menu::query()->where('slug','=','95wrqbW2j0IOScVV')->first()->delete();
        \App\Models\Submenu::query()->where('slug','=','taC50cGUfcKAhwKG')->first()->delete();

    }
}
