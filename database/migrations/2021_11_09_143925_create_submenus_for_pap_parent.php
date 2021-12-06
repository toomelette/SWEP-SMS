<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmenusForPapParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([[
            'slug' => 'nUpJg2eOH07XLrxi',
            'submenu_id' => '9jCDfTum',
            'menu_id' => 'UJRCYH',
            'is_nav' => 0,
            'name' => 'PAP Parent Store',
            'route' => 'dashboard.pap_parent.store',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ],[
            'slug' => 'ymSYPE8KBlUQZpuy',
            'submenu_id' => 'iIPrcxqA',
            'menu_id' => 'UJRCYH',
            'is_nav' => 0,
            'name' => 'PAP Parent Edit',
            'route' => 'dashboard.pap_parent.edit',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ],[
            'slug' => 'fTdrzlT6GcGpwEu9',
            'submenu_id' => 'IaACJWlLh',
            'menu_id' => 'UJRCYH',
            'is_nav' => 0,
            'name' => 'PAP Parent Update',
            'route' => 'dashboard.pap_parent.update',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ],[
            'slug' => 'lsEzLVeXmRqJb5y3',
            'submenu_id' => 'FyYlblx',
            'menu_id' => 'UJRCYH',
            'is_nav' => 0,
            'name' => 'PAP Parent Destroy',
            'route' => 'dashboard.pap_parent.destroy',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Submenu::query()->where('slug','=','nUpJg2eOH07XLrxi')->first()->delete();
        \App\Models\Submenu::query()->where('slug','=','ymSYPE8KBlUQZpuy')->first()->delete();
        \App\Models\Submenu::query()->where('slug','=','fTdrzlT6GcGpwEu9')->first()->delete();
        \App\Models\Submenu::query()->where('slug','=','lsEzLVeXmRqJb5y3')->first()->delete();

    }
}
