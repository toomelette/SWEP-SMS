<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrevRefCarryOverOnForm3DetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form2_details',function (Blueprint $table){
           $table->decimal('prev_refinedCarryOver',20,3)->nullable()->after('prev_rawWithdrawals');
        });

        Schema::table('form3_details',function (Blueprint $table){
            $table->decimal('price',20,2)->nullable()->after('prev_refineryMolasses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form2_details',function (Blueprint $table){
            $table->dropColumn('prev_refinedCarryOver');
        });

        Schema::table('form3_details',function (Blueprint $table){
            $table->dropColumn('price');
        });
    }
}
