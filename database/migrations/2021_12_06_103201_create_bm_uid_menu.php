<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBmUidMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::insert([
            'slug' => 'bDdEtBRXnBvBpHJn',
            'submenu_id' => '0io7RHt',
            'menu_id' => 'M10013',
            'is_nav' => 0,
            'name' => 'Edit Biometric User ID',
            'nav_name' => '',
            'route' => 'dashboard.employee.edit_bm_uid',
            'created_at' => \Carbon\Carbon::now(),
            'user_created' => 'SYSTEM',
        ]);

        \App\Models\Submenu::insert([
            'slug' => 'g0COIBbbeTa6jKEv',
            'submenu_id' => 'SRUPzQl',
            'menu_id' => 'M10013',
            'is_nav' => 0,
            'name' => 'Update Biometric User ID',
            'nav_name' => '',
            'route' => 'dashboard.employee.update_bm_uid',
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
        $sm = \App\Models\Submenu::query()->where('slug','=','bDdEtBRXnBvBpHJn')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','g0COIBbbeTa6jKEv')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
