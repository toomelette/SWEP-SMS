<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmenuForDvPrintPreview extends Migration
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
                'slug' => 'NtxjeuUTtqUsVuRm',
                'submenu_id' => 'KMFPFFN',
                'menu_id' => 'M10003',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Disbursement Voucher Print Preview',
                'route' => 'dashboard.disbursement_voucher.print_preview',
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
        $sm = \App\Models\Submenu::query()->where('slug','=','NtxjeuUTtqUsVuRm')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
