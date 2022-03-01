<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenuAndSubmenuBudgetProposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Submenu::query()->insert([
           [
               'slug' => '3oQtW4D822SM4JvL',
               'submenu_id' => 'PIBZZGB',
               'menu_id' => 'ZSIIXC',
               'is_nav' => 0,
               'route' => 'dashboard.budget_proposal.store',
               'name' => 'Budget Proposal Store',
           ],
            [
                'slug' => 'NRWUxwe2oXMYxx7i',
                'submenu_id' => 'L87S4ID',
                'menu_id' => 'ZSIIXC',
                'is_nav' => 0,
                'route' => 'dashboard.budget_proposal.show',
                'name' => 'Budget Proposal Show',
            ],
            [
                'slug' => 'XPvC2uNO8DrIFBFH',
                'submenu_id' => 'WMMYGHV',
                'menu_id' => 'ZSIIXC',
                'is_nav' => 0,
                'route' => 'dashboard.budget_proposal.edit',
                'name' => 'Budget Proposal Edit',
            ],
            [
                'slug' => 'Zr2WRTqmmj31evf1',
                'submenu_id' => 'X4RDQEZ',
                'menu_id' => 'ZSIIXC',
                'is_nav' => 0,
                'route' => 'dashboard.budget_proposal.Update',
                'name' => 'Budget Proposal Update',
            ],
            [
                'slug' => 'If6eTjUjppIonmFQ',
                'submenu_id' => 'WRRFP4A',
                'menu_id' => 'ZSIIXC',
                'is_nav' => 0,
                'route' => 'dashboard.budget_proposal.destroy',
                'name' => 'Budget Proposal Destroy',
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
        $sm = \App\Models\Submenu::query()->where('slug','=','3oQtW4D822SM4JvL')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','NRWUxwe2oXMYxx7i')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','XPvC2uNO8DrIFBFH')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','Zr2WRTqmmj31evf1')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','If6eTjUjppIonmFQ')->first();
        if(!empty($sm)){
            $sm->delete();
        }

    }
}
