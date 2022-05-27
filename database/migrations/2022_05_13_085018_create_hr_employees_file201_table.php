<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrEmployeesFile201Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_file201', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('employee_no');
            $table->string('title');
            $table->string('description');
            $table->string('type');
            $table->string('original_filename');
            $table->string('filename');
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });

//        DB::statement('ALTER TABLE `swep_afd`.`hr_employee_file201`
//            ADD COLUMN `file_ext` VARCHAR(45) NULL AFTER `filename`;
//        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_employee_file201');
    }
}
