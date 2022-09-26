<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormTypeOnTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_reports_details',function (Blueprint $table){
            $table->string('form_type');
        });
        Schema::table('weekly_reports_series_pcs',function (Blueprint $table){
            $table->string('form_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_reports_details',function (Blueprint $table){
            $table->dropColumn('form_type');
        });
        Schema::table('weekly_reports_series_pcs',function (Blueprint $table){
            $table->dropColumn('form_type');
        });
    }
}
