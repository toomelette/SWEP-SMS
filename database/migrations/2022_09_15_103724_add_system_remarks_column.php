<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSystemRemarksColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_employee_educational_background',function (Blueprint $table){
            $table->string('system_remarks');
        });

        Schema::table('hr_employee_eligibilities',function (Blueprint $table){
            $table->string('system_remarks');
        });
        Schema::table('hr_employee_experiences',function (Blueprint $table){
            $table->string('system_remarks');
        });
        Schema::table('hr_employee_file201',function (Blueprint $table){
            $table->string('system_remarks');
        });
        Schema::table('hr_employee_trainings',function (Blueprint $table){
            $table->string('system_remarks');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_employee_educational_background',function (Blueprint $table){
            $table->removeColumn('system_remarks');
        });

        Schema::table('hr_employee_eligibilities',function (Blueprint $table){
            $table->removeColumn('system_remarks');
        });
        Schema::table('hr_employee_experiences',function (Blueprint $table){
            $table->removeColumn('system_remarks');
        });
        Schema::table('hr_employee_file201',function (Blueprint $table){
            $table->removeColumn('system_remarks');
        });
        Schema::table('hr_employee_trainings',function (Blueprint $table){
            $table->removeColumn('system_remarks');
        });
    }
}
