<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuForBudgetProposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Menu::insert([
            [
            'slug' => 'UK2AcmsyerKvop74',
            'menu_id' => 'ZSIIXC',
            'category' => 'PPU',
            'name' => 'Budget Proposal',
            'route' => 'dashboard.recommended_budget.*',
            'icon' => 'fa-times',
            'is_menu' => 1,
            'is_dropdown' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'user_created' => 'SYSTEM',
            ]
        ]);

        \App\Models\Submenu::insert([
            [
                'slug' => 'AHNkw3IGz7p2YQIy',
                'submenu_id' => '7JDB2Y',
                'menu_id' => 'ZSIIXC',
                'is_nav' => 1,
                'nav_name' =>'Prepare Budget Proposal',
                'name' => 'Budget Proposal Create',
                'route' => 'dashboard.recommended_budget.create',
            ],
            [
                'slug' => 'J6Q8ybK0HVFW7Gom',
                'submenu_id' => 'KSBGZ04',
                'menu_id' => 'ZSIIXC',
                'is_nav' => 1,
                'nav_name' =>'Prepare Budget Proposal Index',
                'name' => 'Budget Proposal Index',
                'route' => 'dashboard.recommended_budget.index',
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
        $menu = \App\Models\Menu::query()->where('slug','=', 'UK2AcmsyerKvop74')->first();
        if(!empty($menu)){
            $menu->delete();
        }

        $submenu = \App\Models\Submenu::query()->where('slug','=','AHNkw3IGz7p2YQIy')->first();
        if(!empty($submenu)){
            $submenu->delete();
        }

        $submenu = \App\Models\Submenu::query()->where('slug','=','J6Q8ybK0HVFW7Gom')->first();
        if(!empty($submenu)){
            $submenu->delete();
        }
    }
}
