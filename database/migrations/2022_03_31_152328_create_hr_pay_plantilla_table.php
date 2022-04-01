<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrPayPlantillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_pay_plantilla', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->integer('item_no');
            $table->integer('department_header');
            $table->string('department');
            $table->integer('division_header');
            $table->string('division');
            $table->integer('section_header');
            $table->string('section');
            $table->string('position');
            $table->string('employee_no')->nullable();
            $table->string('employee_name')->nullable();
            $table->integer('job_grade')->nullable();
            $table->integer('step_inc')->nullable();
            $table->decimal('actual_salary',10,2)->nullable();
            $table->decimal('actual_salary_gcg',10,2)->nullable();
            $table->string('eligibility')->nullable();
            $table->string('educ_att')->nullable();
            $table->string('appointment_status')->nullable();
            $table->date('appointment_date')->nullable();
            $table->date('last_promotion')->nullable();
            $table->integer('seq_groupings')->nullable();
            $table->integer('div_groupings')->nullable();
            $table->integer('original_job_grade')->nullable();
            $table->integer('original_job_grade_si')->nullable();
            $table->integer('original_salary_grade')->nullable();
            $table->integer('original_salary_grade_si')->nullable();
            $table->integer('control_no');
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_pay_plantilla');
    }
}
