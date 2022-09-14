<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseToHrApplicants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_applicants', function (Blueprint $table) {
            DB::statement('ALTER TABLE `swep_afd`.`hr_applicants` 
                                ADD COLUMN `course` VARCHAR(255) NULL AFTER `course_id`;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_applicants', function (Blueprint $table) {
            $table->removeColumn('course');
        });
    }
}
